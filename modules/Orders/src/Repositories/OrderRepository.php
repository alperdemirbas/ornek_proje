<?php

namespace Rezyon\Orders\Repositories;

use Rezyon\Orders\Enums\OrderStatusEnum;
use Rezyon\Orders\Models\OrderReturn;
use Rezyon\Orders\Models\Orders;

class OrderRepository
{
    protected Orders $orders;
    protected OrderReturn $return;

    public function __construct(
        Orders $orders,
        OrderReturn $return
    )
    {
        $this->orders = $orders;
        $this->return = $return;
    }

    public function getByOID(string $oid)
    {
        return $this->orders->newQuery()->with(['discount', 'cart.activity', 'user.cartDiscount'])->where('merchant_oid', $oid)->first();
    }

    public function create(array $fields)
    {
        return $this->orders->newQuery()->create($fields);
    }

    public function changeStatus(string $merchantOID, OrderStatusEnum $status)
    {
        return $this->orders->newQuery()->where('merchant_oid', $merchantOID)->update(['status' => $status]);
    }

    public function completeOrder(array $fields)
    {
        return $this->orders->newQuery()->where('merchant_oid', $fields['merchant_oid'])->update($fields);
    }

    public function getOrders(int $userId)
    {
        return $this->orders->newQuery()
            ->where('users_id', $userId)
            ->where('status', '!=', OrderStatusEnum::INCOMPLETE)
            ->with([
                'discount:id,discount_rate,code',
                'cart:id,orders_id,selected_time,activity_session_id,activity_id',
                'cart.tickets:carts_id,owner_id',
                'cart.session',
                'cart.activity:id,name,views',
                'cart.activity.images:activity_id,path'
            ])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getOrderDetails(int $id, int $cartId)
    {
        return $this->orders->newQuery()
            ->select('id')
            ->where('id', $id)
            ->where('status', '!=', OrderStatusEnum::INCOMPLETE)
            ->with([
                'cart' => function ($query) use ($cartId) {
                    $query->where('id', $cartId);
                    $query->select(['id', 'orders_id', 'price', 'activity_id', 'activity_session_id']);
                    $query->with(['tickets', 'session']);
                    $query->with('activity:id,name,views');
                    $query ->doesntHave('cancelled');
                }
            ])
            ->first();
    }

    public function getById(int $id)
    {
        return $this->orders->newQuery()
            ->where('id', $id)
            ->where('status', '!=', OrderStatusEnum::INCOMPLETE)
            ->with('cart')
            ->first();
    }

    public function createReturn(array $fields)
    {
        return $this->return->newQuery()->create($fields);
    }
}