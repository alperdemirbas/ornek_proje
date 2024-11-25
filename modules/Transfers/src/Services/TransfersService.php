<?php

namespace Rezyon\Transfers\Services;

use Rezyon\Transfers\Repositories\TransfersRepository;
use Rezyon\Transfers\Repositories\TransferUsersRepository;
use Rezyon\Transfers\Transfer;

class TransfersService
{
    protected TransfersRepository $transfersRepository;
    protected TransferUsersRepository $transferUsersRepository;

    public function __construct(
        TransfersRepository $transfersRepository,
        TransferUsersRepository $transferUsersRepository
    )
    {
        $this->transfersRepository = $transfersRepository;
        $this->transferUsersRepository = $transferUsersRepository;
    }

    public function find(int $id)
    {
        return $this->transfersRepository->find($id);
    }

    public function create(Transfer $transfer)
    {
        return $this->transfersRepository->create([
            'users_id' => $transfer->getUserId(),
            'activity_id' => $transfer->getActivityId(),
            'hotel_id' => $transfer->getHotelId(),
            'activity_session_id' => $transfer->getSessionId(),
            'cars_id' => $transfer->getCarId(),
            'date' => $transfer->getDate(),
            'time' => $transfer->getTime(),
            'driver_name' => $transfer->getDriverName(),
            'driver_phone' => $transfer->getDriverPhone(),
            'driver_phone_country' => $transfer->getDriverPhoneCountry()
        ]);
    }

    public function delete(int $id)
    {
        return $this->transfersRepository->delete($id);
    }
}