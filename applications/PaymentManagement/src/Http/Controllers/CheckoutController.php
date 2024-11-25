<?php

namespace Rezyon\Applications\PaymentManagement\Http\Controllers;


use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Rezyon\Checkouts\Checkout;
use Rezyon\Checkouts\CheckoutService;
use Rezyon\Checkouts\CheckoutStatusEnums;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;
use Rezyon\Companies\Interfaces\CompanyPackageServiceInterface;
use Rezyon\Packages\Interfaces\PackagesServiceInterface;
use Rezyon\PaymentManagement\Customer;
use Rezyon\PaymentManagement\Enums\UserPaymentTypesEnum;
use Rezyon\PaymentManagement\Product;
use Rezyon\PaymentManagement\Services\Service;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckoutController
{
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

    public function getInstallments()
    {
        
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

    public function checkout(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();

            if (!$token->check()) {
                return response()->json(['status' => 'error', 'message' => 'Geçersiz token'], 401);
            }

            return response()->json(['status' => 'success', 'url' => route('pay')]);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token çözümlenemedi'], 500);
        }
    }

    public function pay(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();

            if (!$token->check()) {
                return response()->json(['status' => 'error', 'message' => 'Geçersiz token'], 401);
            }

            $service = new Service(UserPaymentTypesEnum::ADMIN);

            return response()->view('applications.payment.management::checkout', ['domain' => $request->header('domain'), 'data' => [
                'installments' => $service->getSupportedInstallment(),
                'credit_cards' => $service->supportedCreditCardList(),

            ]]);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token çözümlenemedi'], 500);
        }
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

    public function test(Request $request)
    {
        $merchant_id = '311582';
        $merchant_key = '76rLH62Dk9UwfoKT';
        $merchant_salt = 'U2fRz1se6kbipxmT';

        // Request ile gelen veriler
        $email = $request->user()->email;
        $payment_amount = 129.92 * 100; // 9.99 için 999 olarak gönderilmelidir
        $merchant_oid = uniqid(); // Benzersiz sipariş numarası
        $user_name = $request->user()->firstname.' '.$request->user()->lastname;
        $user_address = "test address";
        $user_phone = "905555555555";
        $merchant_ok_url = route('payment.paytr.success'); // Ödeme başarılı sayfası
        $merchant_fail_url = route('payment.paytr.error'); // Ödeme başarısız sayfası
        $user_basket = base64_encode(json_encode(array(
            array("Örnek ürün 1", "18.00", 1), // 1. ürün (Ürün Ad - Birim Fiyat - Adet )
            array("Örnek ürün 2", "33.25", 2), // 2. ürün (Ürün Ad - Birim Fiyat - Adet )
            array("Örnek ürün 3", "45.42", 1)  // 3. ürün (Ürün Ad - Birim Fiyat - Adet )
        )));

        // Kullanıcı IP adresi
        $user_ip = $request->ip();

        $timeout_limit = "30";
        $debug_on = 1;
        $test_mode = 1;
        $no_installment = 0;
        $max_installment = 0;
        $currency = "TL";

        $hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $user_basket . $no_installment . $max_installment . $currency . $test_mode;
        $paytr_token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));

        $post_vals = [
            'merchant_id' => $merchant_id,
            'user_ip' => $user_ip,
            'merchant_oid' => $merchant_oid,
            'email' => $email,
            'payment_amount' => $payment_amount,
            'paytr_token' => $paytr_token,
            'user_basket' => $user_basket,
            'debug_on' => $debug_on,
            'no_installment' => $no_installment,
            'max_installment' => $max_installment,
            'user_name' => $user_name,
            'user_address' => $user_address,
            'user_phone' => $user_phone,
            'merchant_ok_url' => $merchant_ok_url,
            'merchant_fail_url' => $merchant_fail_url,
            'timeout_limit' => $timeout_limit,
            'currency' => $currency,
            'test_mode' => $test_mode,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        // Eğer lokal ortamda SSL hatası alırsanız aşağıdaki satırı açın.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = @curl_exec($ch);

        if (curl_errno($ch)) {
            return response()->json(['error' => 'PAYTR IFRAME connection error. err:' . curl_error($ch)], 500);
        }

        curl_close($ch);

        $result = json_decode($result, true);

        if ($result['status'] == 'success') {
            return response()->json(['token' => $result['token']]);
        } else {
            return response()->json(['error' => 'PAYTR IFRAME failed. reason:' . $result['reason']], 500);
        }
    }


}