<?php

namespace Rezyon\Tickets\Repositories;

use Carbon\Carbon;
use Rezyon\Tickets\Models\Tickets;
use Rezyon\Users\Models\Users;

class TicketsRepository
{
    protected Tickets $model;

    public function __construct(Tickets $model)
    {
        $this->model = $model;
    }

    public function getById(int $id)
    {
        return $this->model->newQuery()->find($id);
    }

    public function ticketDetails(int $ticketId)
    {
        $userId = request()->user()->id;
        return $this->model->newQuery()
            ->where('id', $ticketId)
            /*->where(function ($query) use ($userId) {
                $query->where('users_id', $userId)
                    ->orWhere('owner_id', $userId);
            })*/
            ->doesntHave('cart.cancelled')
            ->with(['activity', 'user', 'owner', 'approving'])
            ->first();
    }

    public function addTicketToWallet(string $code, int $userId)
    {
        return $this->model->newQuery()
            ->where('code', $code)
            ->update(['owner_id' => $userId]);
    }

    public function create(array $data)
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(int $ticketId, array $data)
    {
        return $this->model->newQuery()->where('id', $ticketId)->update($data);
    }

    public function list(int $userId)
    {
        return $this->model->newQuery()
            ->where('owner_id', $userId)
            ->with('activity:id,name,views')
            ->doesntHave('cart.cancelled')
            ->orderByRaw("CASE WHEN start_time >= NOW() THEN 0 ELSE 1 END")
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function useTicket(int $ticketId, int $approvedBy)
    {
        return $this->model->newQuery()
            ->where('id', $ticketId)
            ->update(['approved_by' => $approvedBy, 'used_at' => now()]);
    }

    public function assignOwner(int $ticketId, int $ownerId)
    {
        return $this->model->newQuery()
            ->where('id', $ticketId)
            ->update(['owner_id' => $ownerId]);
    }

    public function removeAssignment(int $ticketId)
    {
        return $this->model->newQuery()
            ->where('id', $ticketId)
            ->update(['owner_id' => null]);
    }
}