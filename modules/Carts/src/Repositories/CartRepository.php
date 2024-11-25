<?php

namespace Rezyon\Carts\Repositories;

use Rezyon\Carts\Models\Carts;

class CartRepository
{
    protected Carts $model;

    public function __construct(Carts $model)
    {
        $this->model = $model;
    }

    public function find(int $id)
    {
        return $this->model->newQuery()->find($id);
    }

    public function get(int $userId)
    {
        return $this->model->newQuery()->where(['users_id' => $userId, 'status' => false, 'orders_id' => null])->with('activity', 'session')->get();
    }

    public function getCartByOrderId(int $orderId)
    {
        return $this->model->newQuery()->where(['orders_id' => $orderId])->with('activity', 'session')->get();
    }

    public function create(array $cart)
    {
        return $this->model->newQuery()->create($cart);
    }

    public function isConflict(array $fields)
    {
        return $this->model->newQuery()
            ->where($fields)
            ->first();
    }

    public function update(int $id, array $fields)
    {
        return $this->model->newQuery()
            ->where('id', $id)
            ->update($fields);
    }

    public function clearCart(int $userId, int $orderId)
    {
        return $this->model->newQuery()->where(['users_id' => $userId, 'status' => false])->whereNull('orders_id')->update(['orders_id' => $orderId, 'status' => true]);
    }

    public function delete(int $id)
    {
        return $this->model->newQuery()->where('id', $id)->delete();
    }

    public function getTotal(int $userId)
    {
        return $this->model->newQuery()->where(['users_id' => $userId, 'status' => false])->sum('price');
    }

    public function retreiveCard(int $userId)
    {
        return $this->model->newQuery()
            ->withTrashed()
            ->where('users_id', $userId)
            ->whereNull('orders_id')
            ->restore();
    }

    public function setOrder(int $userId, int $orderId)
    {
        return $this->model->newQuery()
            ->where('users_id', $userId)
            ->update(['orders_id' => $orderId, 'status' => true]);
    }

    public function getCapacityCount(int $sessionId, string $selectedTime, int $activityId)
    {
        $query = $this->model->newQuery()
            ->where('activity_session_id', $sessionId)
            ->where('selected_time', $selectedTime)
            ->where('activity_id', $activityId)
            ->whereNotNull('orders_id')
            ->where('status', true)
            ->selectRaw('SUM(adult) as total_adult, SUM(child) as total_child, SUM(baby) as total_baby')
            ->first();

        if($query) {
            return $query->total_adult + $query->total_child + $query->total_baby;
        } else {
            return null;
        }
    }

    public function getActivityOrdersByDates(int $activityId)
    {
        return $this->model->newQuery()
            ->where('activity_id', $activityId)
            ->whereNotNull('orders_id')
            ->where('status', true)
            ->where('selected_time', '>', now())
            ->distinct()
            ->pluck('selected_time');
    }
}