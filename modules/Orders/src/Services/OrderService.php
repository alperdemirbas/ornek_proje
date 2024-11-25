<?php

namespace Rezyon\Orders\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Orders\Enums\OrderStatusEnum;
use Rezyon\Orders\Order;
use Rezyon\Orders\OrderReturn;
use Rezyon\Orders\Repositories\OrderRepository;

class OrderService
{
    protected OrderRepository $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByOID(string $oid)
    {
        return $this->repository->getByOID($oid);
    }

    /**
     * @param Order $order
     * @return Model|Builder
     */
    public function createOrder(Order $order): Model|Builder
    {
        return $this->repository->create([
            "users_id" => $order->getUser()->id,
            "count" => $order->getCount(),
            "merchant_oid" => $order->getMerchantOID(),
            "user_ip" => $order->getIp(),
            "amount" => $order->getAmount(),
            "installment_count" => $order->getInstallmentCount(),
            "status" => $order->getStatus(),
            "currency" => $order->getCurrency()->name,
            "discounts_id" => $order->getDiscount()->id ?? null,
            "order_type" => $order->getOrderType()
        ]);
    }

    public function getOrderDetails(int $orderId, int $cartId)
    {
        return $this->repository->getOrderDetails($orderId, $cartId);
    }

    public function changeStatus(string $merchantOID, OrderStatusEnum $status)
    {
        return $this->repository->changeStatus($merchantOID, $status);
    }

    public function completeOrder(
        string $merchantOID,
        float $totalAmount,
        string $installmentCount,
        OrderStatusEnum $status,
        int $failedReasonCode = null,
        string $failedReasonMessage = null
    )
    {
        return $this->repository->completeOrder([
            'merchant_oid' => $merchantOID,
            'total_amount' => $totalAmount,
            'installment_count' => $installmentCount,
            'status' => $status,
            'failed_reason_code' => $failedReasonCode,
            'failed_reason_msg' => $failedReasonMessage
        ]);
    }

    public function getOrders(int $userId)
    {
        return $this->repository->getOrders($userId);
    }

    public function getById(int $id)
    {
        return $this->repository->getById($id);
    }

    public function createReturn(OrderReturn $return)
    {
        return $this->repository->createReturn([
            "carts_id" => $return->getCartId(),
            "reference_no" => $return->getReferenceNo(),
            "return_amount" => $return->getReturnAmount(),
            "status" => $return->getStatus()
        ]);
    }
}