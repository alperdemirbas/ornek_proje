<?php

namespace Rezyon\Tickets;

use Rezyon\Carts\Models\Carts;
use Rezyon\Supplier\Models\Activity;
use Rezyon\Users\Models\Users;
use \Rezyon\TourismCompanyUser\Models\Users as TourismUser;

class Ticket
{
    protected Activity $activity;
    protected Users|TourismUser $user;
    protected Carts $cart;
    protected string $startTime;
    protected string $endTime;

    /**
     * @return Activity
     */
    public function getActivity(): Activity
    {
        return $this->activity;
    }

    /**
     * @param Activity $activity
     */
    public function setActivity(Activity $activity): void
    {
        $this->activity = $activity;
    }

    /**
     * @return TourismUser|Users
     */
    public function getUser(): TourismUser|Users
    {
        return $this->user;
    }

    /**
     * @param TourismUser|Users $user
     */
    public function setUser(TourismUser|Users $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Carts
     */
    public function getCart(): Carts
    {
        return $this->cart;
    }

    /**
     * @param Carts $cart
     */
    public function setCart(Carts $cart): void
    {
        $this->cart = $cart;
    }

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * @param string $startTime
     */
    public function setStartTime(string $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->endTime;
    }

    /**
     * @param string $endTime
     */
    public function setEndTime(string $endTime): void
    {
        $this->endTime = $endTime;
    }
}