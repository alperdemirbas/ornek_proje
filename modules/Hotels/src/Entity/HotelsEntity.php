<?php

namespace Rezyon\Hotels\Entity;

use Rezyon\Hotels\Models\Hotel as HotelsModel;
use Rezyon\Hotels\Hotel;

class HotelsEntity
{
    protected HotelsModel $hotels;

    public function __construct(HotelsModel $hotels)
    {
        $this->hotels = $hotels;
    }

    public function find($id)
    {
        return $this->hotels->newQuery()->find($id);
    }

    public function create(Hotel $hotel)
    {
        return $this->hotels->newQuery()->create([
            "users_id" => $hotel->getUser(),
            "name" => $hotel->getName(),
            "phone_country" => $hotel->getPhoneCountry(),
            "phone" => $hotel->getPhone(),
            "address" => $hotel->getAddress(),
            "city_id" => $hotel->getCity(),
            "district_id" => $hotel->getDistrict(),
            "status" => $hotel->getStatus()
        ]);
    }

    public function update(int $id, array $fields)
    {
        return $this->hotels->newQuery()->where('id', $id)->update($fields);
    }

    public function getHotels()
    {
        return $this->hotels->newQuery()->with(['city', 'district'])->get();
    }

    public function getAttachedUsers()
    {
        return $this->hotels->newQuery()->withWhereHas('attachedUsers')->with('assigningUser')->get();
    }

    public function getModel()
    {
        return $this->hotels->newQuery();
    }
}
