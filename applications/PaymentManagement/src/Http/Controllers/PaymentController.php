<?php

namespace Rezyon\Applications\PaymentManagement\Http\Controllers;


use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Rezyon\Applications\PaymentManagement\Exceptions\OrderException;
use Rezyon\Applications\PaymentManagement\Http\Requests\OrderCancellationRequest;
use Rezyon\Applications\PaymentManagement\Http\Requests\OrderWebhookRequest;
use Rezyon\Applications\PaymentManagement\Http\Requests\OrderWebhookResponseRequest;
use Rezyon\Applications\PaymentManagement\Http\Requests\PaymentRequest;
use Rezyon\Carts\Services\CartService;
use Rezyon\Checkouts\Checkout;
use Rezyon\Checkouts\CheckoutService;
use Rezyon\Checkouts\CheckoutStatusEnums;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;
use Rezyon\Companies\Interfaces\CompanyPackageServiceInterface;
use Rezyon\Discounts\Services\DiscountService;
use Rezyon\Orders\Enums\OrderReturnStatusEnum;
use Rezyon\Orders\Enums\OrderStatusEnum;
use Rezyon\Orders\Enums\OrderTypeEnum;
use Rezyon\Orders\Order;
use Rezyon\Orders\OrderReturn;
use Rezyon\Orders\Services\OrderService;
use Rezyon\Packages\Interfaces\PackagesServiceInterface;
use Rezyon\PaymentManagement\Customer;
use Rezyon\PaymentManagement\Enums\UserPaymentTypesEnum;
use Rezyon\PaymentManagement\Product;
use Rezyon\PaymentManagement\Services\Paytr\Enums\CurrencyEnums;
use Rezyon\PaymentManagement\Services\Paytr\Interfaces\ClientInterface;
use Rezyon\PaymentManagement\Services\Service;
use Rezyon\Tickets\Services\TicketsService;
use Rezyon\Tickets\Ticket;

class PaymentController
{
    public function pricing(
        PackagesServiceInterface $packagesService
    )
    {
        $packages = $packagesService->all();
        return view('applications.payment.management::pricing', [
            'packages' => $packages,
            'cycle' => 'fee',
            'type' => 'TOURISM_COMPANY'
        ]);
    }
    public function payData(
        Request $request,
        CompaniesServiceInterface $companiesService,
        CheckoutService           $checkoutService
    ): JsonResponse
    {
        /**
         * @todo form request duzenlecek
         */
        $company = Auth::guard('companies')->user()->company;
        $amount = $companiesService->amount($company);

        $checkout = new Checkout();
        $checkout->setCompanies($company);
        $checkout->setAmount($amount);
        $checkout = $checkoutService->new($checkout);

        $service = new Service(UserPaymentTypesEnum::ADMIN);
        $companyPackage = $companiesService->getWaitingPaymentPackage($company);
        $configType = config('payment.payment_service');
        $config = config('payment.' . $configType);

        $credentials = $service->getCredentials();
        $credentials->setId($config['merchant_id']);
        $credentials->setOid($checkout->merchant_oid);
        $credentials->setKey($config['merchant_key']);
        $credentials->setSalt($config['merchant_salt']);
        $credentials->setOkUrl(_route('payment.sub.success', ['checkout_id' => $checkout->merchant_oid]));
        $credentials->setFailUrl('http://firma-adi-test1.localhost/odeme/basarisiz');

        $service->credentials($credentials);

        $product = new Product();
        $product->setName($companyPackage->packages->name);
        $product->setPiece(1);
        $product->setPrice($amount);

        $service->product($product);

        $customer = new Customer();
        $customer->setName($company->name);
        $customer->setPhone($company->phone);
        $customer->setAddress($company->phone);
        $customer->setEmail($company->email);
        $customer->setIp(request()->ip());

        $service->customer($customer);

        $service->setInstallment($request->post('installment_count'));
        $data = $service->data();
        $data['paytr_token'] = $data['token'];
        unset($data['token']);
        return response()->json($data);
    }

    public function subSuccess(
        string                         $company,
        string                         $checkoutId,
        CheckoutService                $checkoutService,
        CompanyPackageServiceInterface $companyPackageService
    )
    {
        /**
         * @todo Form Request yazilacak
         * @todo 3sn sonra giris ekranina yonlendirilecek.
         * @todo transaction icine alinacak
         */

        $checkoutService->setWaitingApproval($checkoutId);
        $checkout = $checkoutService->findByMerchantOid($checkoutId);


        if (!empty($checkout->company)) {
            $companyPackageService->packageWaitingApproval($checkout->company);
        }
        /**
         * @todo sonra yapilacagi icin bos birakildi
         */
        if (!empty($checkout->user_id)) {

        }
         Auth::logout();

        return view('test.payment-success');
    }

    public function pay()
    {

        $service = new Service(UserPaymentTypesEnum::ADMIN);

        return view('test.pay', ['data' => [
            'installments' => $service->getSupportedInstallment(),
            'credit_cards' => $service->supportedCreditCardList()
        ]]);
    }

    public function paytrError(Request $request)
    {
        return $request->all();
    }

    public function paytrSuccess(
        Request                        $request,
        CheckoutService                $checkoutService,
        CompanyPackageServiceInterface $companyPackageService
    )
    {
        /**
         * @todo Request incelenecek
         */
        $merchant_oid = $request->post('merchant_oid');
        $checkout = $checkoutService->findByMerchantOid($merchant_oid);
        try {
            DB::beginTransaction();
            if (!empty($checkout->company)) {
                if($checkout->status->value === CheckoutStatusEnums::WAITING_APPROVAL->value) {
                    $checkoutService->setSuccess($merchant_oid);
                    $companyPackageService->setSuccess($checkout->company);
                }
            }
            /**
             * @todo sonra yapilacagi icin bos birakildi
             */
            if (!empty($checkout->user_id)) {

            }
            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();
        }
        return response("OK");
    }

    public function subscribe(
        PackagesServiceInterface $packagesService
    )
    {
       $packages= $packagesService->all();
        return view('applications.payment.management::subscribe', ['packages'=>$packages, 'cycle' => 'fee', 'type' => 'TOURISM_COMPANY']);
    }

    /**
     * @param PaymentRequest $request
     * @param CartService $cartService
     * @param ClientInterface $client
     * @param OrderService $orderService
     * @return JsonResponse
     */
    public function payment(
        PaymentRequest $request,
        CartService $cartService,
        ClientInterface $client,
        OrderService $orderService
    ): JsonResponse
    {
        $cartData = $cartService->getCart($request->user()->id);
        if($cartData->count() <= 0) {
            return response()->json(['status' => 'error', 'message' => 'There are no items in your cart.']);
        }
        $amount = $cartData->sum(function ($item) {
            return (float) $item->price;
        });
        $count = $cartData->sum(function ($item) {
            return (int) $item->adult+$item->child+$item->baby;
        });
        $user = $request->user()->load('cartDiscount.discount');
        $ipAddress = $request->ip();
        $merchantOID = generateMerchantOID();
        $discount = $user->cartDiscount->discount ?? null;
        if($discount) {
            $discountedAmount = $amount-($amount/100*$discount->discount_rate);
        }

        DB::beginTransaction();
        $order = new Order();
        $order->setUser($user);
        $order->setCount($count);
        $order->setMerchantOID($merchantOID);
        $order->setIp($ipAddress);
        $order->setAmount($amount);
        $order->setInstallmentCount(0);
        $order->setStatus(OrderStatusEnum::INCOMPLETE);
        $order->setCurrency(CurrencyEnums::TRY);
        $order->setDiscount($discount);
        $order->setOrderType(OrderTypeEnum::ONETIME);
        $orderService->createOrder($order);

        $service = new Service(UserPaymentTypesEnum::ADMIN, $client);
        $configType = config('payment.payment_service');
        $config = config('payment.' . $configType);

        $credentials = $service->getCredentials();
        $credentials->setId($config['merchant_id']);
        $credentials->setOid($merchantOID);
        $credentials->setKey($config['merchant_key']);
        $credentials->setSalt($config['merchant_salt']);
        $credentials->setOkUrl('https://dev.rezyon.com/api/webhook/payment/success/'.$merchantOID);//route('webhook.payment.success', ['token' => $merchantOID]));
        $credentials->setFailUrl('https://dev.rezyon.com/api/webhook/payment/error/'.$merchantOID);//route('webhook.payment.error', ['token' => $merchantOID]));

        $service->credentials($credentials);

        foreach($cartData as $cart) {
            $product = new Product();
            $product->setName($cart->activity->name);
            $product->setPiece($cart->adult+$cart->child+$cart->baby);
            if($discount) {
                $product->setPrice($discountedAmount*($cart->price / $amount));
            } else {
                $product->setPrice($cart->price);
            }
            $service->product($product);
        }

        $customer = new Customer();
        $customer->setName($request->user()->firstname.' '.$request->user()->lastname);
        $customer->setPhone("905555555555");
        $customer->setAddress("test");
        $customer->setEmail($request->user()->email);
        $customer->setIp($ipAddress);

        $service->customer($customer);

        $service->setInstallment(0);
        $service->setNoInstallment(true);
        $service->setMaxInstallment(0);
        $service->setTestMode($config['test_mode']);
        $service->setDebugMode($config['debug_mode']);
        $service->setTimeout($config['timeout']);
        $service->setCurrency(CurrencyEnums::TL);
        $data = $service->data();
        $token = $service->getToken($data);
        if($token->status === "success") {
            DB::commit();
        } else {
            DB::rollBack();
        }
        return response()->json($token);
    }

    /**
     * @param OrderWebhookRequest $request
     * @param OrderService $service
     * @param CartService $cartService
     * @param DiscountService $discountService
     * @param TicketsService $ticketsService
     * @return \Illuminate\Contracts\Foundation\Application|Application|Response|ResponseFactory
     * @throws OrderException
     */
    public function webhook(
        OrderWebhookRequest $request,
        OrderService $service,
        CartService $cartService,
        DiscountService $discountService,
        TicketsService $ticketsService
    ): \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
    {
        $order = $service->getByOID($request->post('merchant_oid'));
        $configType = config('payment.payment_service');
        $config = config('payment.' . $configType);
        $hash = makeOrderHash($request->post('merchant_oid'), $config['merchant_salt'], $request->post('status'), $request->post('total_amount'),   $config['merchant_key']);
        if($hash !== $request->post('hash')) {
            throw new OrderException("The encrypted values of the order do not match", 400);
        }
        DB::beginTransaction();
        try {
            if($order->user->cartDiscount) {
                $discountService->setUsedAt($order->user->cartDiscount->id);
            }
            if($request->post('status') !== 'success' && $order->user->cartDiscount) {
                $discountService->retrieveCode($order->user->cartDiscount->id);
                $cartService->retreiveCard($order->user->id);
            }
            $cartService->clearCart($order->user->id, $order->id);
            $service->completeOrder(
                $request->post('merchant_oid'),
                (float) $request->post('total_amount')/100,
                (int) $request->post('installment_count'),
                $request->post('status') === 'success' ? OrderStatusEnum::COMPLETED : OrderStatusEnum::FAILED,
                $request->post('failed_reason_code') ?? null,
                $request->post('failed_reason_msg') ?? null
            );
            foreach($cartService->getCartByOrderId($order->id) as $cart) {
                if($cart->session) {
                    $startTime = Carbon::parse($cart->selected_time)->format('Y-m-d') ." ". Carbon::parse($cart->session->start_time)->format('H:i:s');
                    $endTime = Carbon::parse($cart->selected_time)->format('Y-m-d') ." ". Carbon::parse($cart->session->end_time)->format('H:i:s');
                } else {
                    $startTime = Carbon::parse($cart->selected_time)->format('Y-m-d') ." ". Carbon::parse($cart->activity->start_time)->format('H:i:s');
                    $endTime = Carbon::parse($cart->selected_time)->format('Y-m-d') ." ". Carbon::parse($cart->activity->end_time)->format('H:i:s');
                }
                $ticket = new Ticket();
                $ticket->setCart($cart);
                $ticket->setUser($order->user);
                $ticket->setActivity($cart->activity);
                $ticket->setStartTime(Carbon::parse($startTime)->format('Y-m-d H:i:s'));
                $ticket->setEndTime(Carbon::parse($endTime)->format('Y-m-d H:i:s'));
                $ticketsService->createTicket($ticket, ($cart->adult + $cart->child + $cart->baby));
            }
            DB::commit();
            return response('OK');
        } catch (\Exception $e) {
            DB::rollback();
            Log::info('error', [$e->getMessage()]);
            return response($e->getMessage(), 400);
        }
    }

    /**
     * @param OrderWebhookResponseRequest $request
     * @param OrderService $service
     * @param CartService $cartService
     * @param DiscountService $discountService
     * @return JsonResponse
     */
    public function webhookPaymentSuccess(
        OrderWebhookResponseRequest $request,
        OrderService $service,
        CartService $cartService,
        DiscountService $discountService
    ): JsonResponse
    {
        $oid = $request->route('token');
        $order = $service->getByOID($oid);
        DB::beginTransaction();
        try {
            if($order->status !== OrderStatusEnum::COMPLETED) {
                $service->changeStatus($oid, OrderStatusEnum::PENDING);
                if($order->user->cartDiscount) {
                    $discountService->setUsedAt($order->user->cartDiscount->id);
                }
                $cartService->clearCart($order->user->id, $order->id);
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        $data = [
            'order_id' => $order->id,
            'order_date' => $order->created_at,
            'amount' => $order->amount
        ];
        if($order->discount) {
            $data['amount'] = $order->amount - ($order->amount / 100 * $order->discount->discount_rate);
        }
        return response()->json([
            'status' => 'success',
            'order' => $data
        ]);
    }

    /**
     * @param OrderWebhookResponseRequest $request
     * @param OrderService $service
     * @return JsonResponse
     */
    public function webhookPaymentError(
        OrderWebhookResponseRequest $request,
        OrderService $service
    ): JsonResponse
    {
        $service->changeStatus($request->route('token'), OrderStatusEnum::FAILED);
        return response()->json(['status' => 'error']);
    }

    public function makeReturn(
        OrderCancellationRequest $request,
        CartService $cartService,
        ClientInterface $client,
        OrderService $orderService,

    )
    {
        $resultData = [];
        $order = $orderService->getById($request->route('order'));
        foreach($request->post('carts') as $cart) {
            $reference = generateReferenceNo();
            $cart = $cartService->getById($cart);
            $now = Carbon::now();
            $price = $cart->price;
            if($cart->session) {
                $session = $cart->session;
                $sessionTime = Carbon::parse($session->start_time)->format('H:i:s');
                $selectedDate = Carbon::parse($cart->selected_time)->format('Y-m-d');
                $startTime = Carbon::parse("{$selectedDate} {$sessionTime}");
                $discountRate = 0;
                foreach ($cart->activity->cancellationConditions as $condition) {
                    if ($startTime->lt($now->addHours($condition->hour))) {
                        $discountRate = $condition->discount_rate;
                        $price = $price - ($price / 100 * $discountRate);
                    }
                }
            } else {
                $selectedDate = Carbon::parse($cart->selected_time)->format('Y-m-d');
                $activityStartTime = Carbon::parse($cart->activity->start_time)->format('H:i:s');
                $startTime = Carbon::parse("{$selectedDate} {$activityStartTime}");
                $discountRate = 0;
                foreach ($cart->activity->cancellationConditions as $condition) {
                    if ($startTime->lt($now->addHours($condition->hour))) {
                        $discountRate = $condition->discount_rate;
                        $price = $price - ($price / 100 * $discountRate);
                    }
                }
            }
            $return = new OrderReturn();
            $return->setReferenceNo($reference);
            $return->setReturnAmount($price);
            $return->setCartId($cart->id);

            $service = new Service(UserPaymentTypesEnum::ADMIN, $client);
            $configType = config('payment.payment_service');
            $config = config('payment.' . $configType);

            $credentials = $service->getCredentials();
            $credentials->setId($config['merchant_id']);
            $credentials->setOid($order->merchant_oid);
            $credentials->setKey($config['merchant_key']);
            $credentials->setSalt($config['merchant_salt']);
            $credentials->setReference($reference);

            $service->credentials($credentials);

            $service->setTotalAmount($price);

            $data = $service->returnData();
            $result = $service->makeReturn($data);
            $return->setStatus(OrderReturnStatusEnum::from($result->status));
            $return->setErrNo($result->err_no ?? null);
            $return->setErrMsg($result->err_msg ?? null);
            $orderService->createReturn($return);

            $resultData[] = [
                "cart_id" => $cart->id,
                "status" => $result->status,
                "merchant_oid" => $result->merchant_oid,
                "return_amount" => $result->return_amount,
                "reference_no" => $result->reference_no
            ];
        }
        return response()->json($resultData);
    }
}