<?php

namespace Rezyon\Hotels\Services;

use Rezyon\Hotels\Entity\HotelsEntity;

class HotelService
{
    protected HotelsEntity $entity;

    public function __construct(HotelsEntity $entity)
    {
        $this->entity = $entity;
    }

    public function getHotel(int $id)
    {
        return $this->entity->find($id);
    }

    public function update(int $id, array $fields)
    {
        return $this->entity->update($id, $fields);
    }

    public function getHotels()
    {
        return $this->entity->getHotels();
    }
}