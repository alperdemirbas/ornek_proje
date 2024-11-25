<?php

namespace Rezyon\Tickets\Services;

use Rezyon\Tickets\Repositories\TicketsRepository;
use Rezyon\Tickets\Ticket;

class TicketsService
{
    protected TicketsRepository $repository;

    public function __construct(TicketsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getById(int $id)
    {
        return $this->repository->getById($id);
    }

    public function createTicket(Ticket $ticket, int $count)
    {
        for($i = 0; $i < $count; $i++) {
            $this->repository->create([
                'activity_id' => $ticket->getActivity()->id,
                'users_id' => $ticket->getUser()->id,
                'carts_id' => $ticket->getCart()->id,
                'start_time' => $ticket->getStartTime(),
                'end_time' => $ticket->getEndTime(),
            ]);
        }

        return true;
    }

    public function addTicketToWallet(string $code, int $userId)
    {
        return $this->repository->addTicketToWallet($code, $userId);
    }

    public function assignOwner(int $ticketId, int $ownerId)
    {
        return $this->repository->assignOwner($ticketId, $ownerId);
    }

    public function removeAssignment(int $ticketId)
    {
        return $this->repository->removeAssignment($ticketId);
    }

    public function useTicket(int $ticketId, int $approvedBy)
    {
        return $this->repository->useTicket($ticketId, $approvedBy);
    }

    public function listTickets(int $userId)
    {
        return $this->repository->list($userId);
    }

    public function ticketDetails(int $ticketId)
    {
        return $this->repository->ticketDetails($ticketId);
    }
}