<?php

namespace Rezyon\Carts\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Carts\Carts;
use Rezyon\Carts\Exceptions\ActivityAlreadyInCartException;
use Rezyon\Carts\Repositories\CartRepository;

class CartService
{
    protected CartRepository $cartRepository;
    
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getCart(int $userId)
    {
        return $this->cartRepository->get($userId);
    }

    public function getById(int $id)
    {
        return $this->cartRepository->find($id);
    }

    public function clearCart(int $userId, int $orderId)
    {
        return $this->cartRepository->clearCart($userId, $orderId);
    }

    public function setOrder(int $userId, int $orderId)
    {
        return $this->cartRepository->setOrder($userId, $orderId);
    }

    public function getCartByOrderId(int $orderId)
    {
        return $this->cartRepository->getCartByOrderId($orderId);
    }

    /**
     * @param Carts $cart
     * @return Model|Builder
     * @throws ActivityAlreadyInCartException
     */
    public function addToCart(Carts $cart): Model|Builder
    {
        $isConflict = $this->cartRepository->isConflict([
            'activity_id' => $cart->getActivity(),
            'users_id' => $cart->getUser(),
            'selected_time' => $cart->getSelectedTime(),
            'activity_session_id' => $cart->getSession(),
            'orders_id' => null,
            'status' => false
        ]);

        if ($isConflict) {
            throw new ActivityAlreadyInCartException();
        }

        return $this->cartRepository->create([
            'activity_id' => $cart->getActivity(),
            'users_id' => $cart->getUser(),
            'price' => $cart->getPrice(),
            'selected_time' => $cart->getSelectedTime(),
            'activity_session_id' => $cart->getSession(),
            'adult' => $cart->getAdult(),
            'child' => $cart->getChild(),
            'baby' => $cart->getBaby(),
            'status' => $cart->getStatus()
        ]);
    }

    /**
     * @param int $id
     * @param array $fields
     * @return int
     */
    public function update(int $id, array $fields): int
    {
        return $this->cartRepository->update($id, $fields);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->cartRepository->delete($id);
    }

    public function getTotal(int $userId)
    {
        return $this->cartRepository->getTotal($userId);
    }

    public function retreiveCard(int $userId)
    {
        return $this->cartRepository->retreiveCard($userId);
    }

    public function getCapacityCount(int $sessionId, string $selectedTime, int $activityId)
    {
        return $this->cartRepository->getCapacityCount($sessionId, $selectedTime, $activityId);
    }

    public function getActivityOrdersByDates(int $activityId)
    {
        return $this->cartRepository->getActivityOrdersByDates($activityId);
    }
}