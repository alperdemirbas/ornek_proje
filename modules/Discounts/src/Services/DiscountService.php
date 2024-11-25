<?php

namespace Rezyon\Discounts\Services;

use Rezyon\Discounts\Discount;
use Rezyon\Discounts\Repositories\DiscountRepository;
use Rezyon\Discounts\Repositories\UserDiscountRepository;

class DiscountService
{
    protected DiscountRepository $repository;
    protected UserDiscountRepository $userDiscountRepository;

    public function __construct(
        DiscountRepository $repository,
        UserDiscountRepository $userDiscountRepository
    )
    {
        $this->repository = $repository;
        $this->userDiscountRepository = $userDiscountRepository;
    }

    public function findByCode(string $code)
    {
        return $this->repository->findByCode($code);
    }

    public function getUserDiscounts(int $userId)
    {
        return $this->userDiscountRepository->getUserDiscounts($userId);
    }

    public function createDiscount(Discount $discount)
    {
        return $this->repository->create([
            'discount_rate' => $discount->getDiscountRate(),
            'max_using' => $discount->getMaxUsing(),
            'users_id' => $discount->getUser()->id,
            'code' => $discount->getCode(),
            'validity_date' => $discount->getValidityDate(),
        ]);
    }

    public function useCode(int $userId, int $discountId)
    {
        return $this->userDiscountRepository->create([
            'users_id' => $userId,
            'discounts_id' => $discountId,
        ]);
    }

    public function setUsedAt(int $id)
    {
        return $this->userDiscountRepository->setUsedAt($id);
    }

    public function retrieveCode(int $id)
    {
        return $this->userDiscountRepository->retrieveCode($id);
    }

    public function removeCode(int $id)
    {
        return $this->userDiscountRepository->delete($id);
    }

}