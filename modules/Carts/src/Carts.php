<?php

namespace Rezyon\Carts;

use Rezyon\Discounts\Models\Discounts;
use Rezyon\Supplier\Models\Activity;
use Rezyon\Users\Models\Users;

class Carts
{
    protected int $activity;
    protected int $user;
    protected string $price;
    protected string $selectedTime;
    protected ?string $session = null;
    protected ?int $adult = null;
    protected ?int $child = null;
    protected ?int $baby = null;
    protected bool $status;

    /**
     * @return int
     */
    public function getActivity(): int
    {
        return $this->activity;
    }

    /**
     * @param int $activity
     */
    public function setActivity(int $activity): void
    {
        $this->activity = $activity;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getSelectedTime(): string
    {
        return $this->selectedTime;
    }

    /**
     * @param string $selectedTime
     */
    public function setSelectedTime(string $selectedTime): void
    {
        $this->selectedTime = $selectedTime;
    }

    /**
     * @return string|null
     */
    public function getSession(): ?string
    {
        return $this->session;
    }

    /**
     * @param string|null $session
     */
    public function setSession(?string $session): void
    {
        $this->session = $session;
    }

    /**
     * @return int|null
     */
    public function getAdult(): ?int
    {
        return $this->adult;
    }

    /**
     * @param int|null $adult
     */
    public function setAdult(?int $adult): void
    {
        $this->adult = $adult;
    }

    /**
     * @return int|null
     */
    public function getChild(): ?int
    {
        return $this->child;
    }

    /**
     * @param int|null $child
     */
    public function setChild(?int $child): void
    {
        $this->child = $child;
    }

    /**
     * @return int|null
     */
    public function getBaby(): ?int
    {
        return $this->baby;
    }

    /**
     * @param int|null $baby
     */
    public function setBaby(?int $baby): void
    {
        $this->baby = $baby;
    }


    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}