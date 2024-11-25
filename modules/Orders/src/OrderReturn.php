<?php

namespace Rezyon\Orders;

use Rezyon\Orders\Enums\OrderReturnStatusEnum;

class OrderReturn
{
    protected int $cartId;
    protected string $reference_no;
    protected float $return_amount;
    protected OrderReturnStatusEnum $status;
    protected ?string $err_no = null;
    protected ?string $err_msg = null;

    /**
     * @return int
     */
    public function getCartId(): int
    {
        return $this->cartId;
    }

    /**
     * @param int $cartId
     */
    public function setCartId(int $cartId): void
    {
        $this->cartId = $cartId;
    }

    /**
     * @return string
     */
    public function getReferenceNo(): string
    {
        return $this->reference_no;
    }

    /**
     * @param string $reference_no
     */
    public function setReferenceNo(string $reference_no): void
    {
        $this->reference_no = $reference_no;
    }

    /**
     * @return float
     */
    public function getReturnAmount(): float
    {
        return $this->return_amount;
    }

    /**
     * @param float $return_amount
     */
    public function setReturnAmount(float $return_amount): void
    {
        $this->return_amount = $return_amount;
    }

    /**
     * @return OrderReturnStatusEnum
     */
    public function getStatus(): OrderReturnStatusEnum
    {
        return $this->status;
    }

    /**
     * @param OrderReturnStatusEnum $status
     */
    public function setStatus(OrderReturnStatusEnum $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getErrNo(): ?string
    {
        return $this->err_no;
    }

    /**
     * @param string|null $err_no
     */
    public function setErrNo(?string $err_no): void
    {
        $this->err_no = $err_no;
    }

    /**
     * @return string|null
     */
    public function getErrMsg(): ?string
    {
        return $this->err_msg;
    }

    /**
     * @param string|null $err_msg
     */
    public function setErrMsg(?string $err_msg): void
    {
        $this->err_msg = $err_msg;
    }
}