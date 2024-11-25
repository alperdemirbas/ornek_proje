<?php

namespace Rezyon\PaymentManagement;

class Product
{
    protected string $name;
    protected float $price;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPiece(): int
    {
        return $this->piece;
    }

    public function setPiece(int $piece): void
    {
        $this->piece = $piece;
    }
    protected int $piece;

}