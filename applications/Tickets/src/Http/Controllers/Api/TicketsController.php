<?php

namespace Rezyon\Applications\Tickets\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rezyon\Applications\Tickets\Http\Requests\AddTicketToWalletRequest;
use Rezyon\Applications\Tickets\Http\Requests\OwnTicketRequest;
use Rezyon\Applications\Tickets\Http\Resources\TicketCollection;
use Rezyon\Applications\Tickets\Http\Resources\TicketResource;
use Rezyon\Applications\Tickets\Http\Resources\TicketsCollection;
use Rezyon\Tickets\Services\TicketsService;
use Rezyon\Users\UserService;

class TicketsController extends Controller
{
    public function list(
        Request $request,
        TicketsService $service
    )
    {
        return new TicketsCollection(collect($service->listTickets($request->user()->id)));
    }

    public function useTicket(
        Request $request,
        TicketsService $service
    )
    {
        return $service->useTicket($request->route('ticket'));
    }

    public function ownTicket(
        OwnTicketRequest $request,
        TicketsService $service
    )
    {
        $assignment =  $service->assignOwner($request->route('ticket'), $request->post('user_id'));
        if($assignment) {
            return response()->json(['status' => 'success', 'message' => 'User assignment for ticket was successfully']);

        }
        return response()->json(['status' => 'error', 'message' => 'Failed to assign user for ticket']);
    }

    public function addTicketToWallet(
        AddTicketToWalletRequest $request,
        TicketsService $service
    )
    {
        $assignment =  $service->addTicketToWallet($request->post('code'), $request->user()->id);
        if($assignment) {
            return response()->json(['status' => 'success', 'message' => 'Ticket successfully added to the account.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Failed to add the ticket to the account.']);
    }

    public function removeAssignment(
        Request $request,
        TicketsService $service
    )
    {
        $assignment =  $service->removeAssignment($request->route('ticket'));
        if($assignment) {
            return response()->json(['status' => 'success', 'message' => 'Assignment successfully removed']);
        }
        return response()->json(['status' => 'error', 'message' => 'Failed to remove the assignment']);
    }

    public function show(
        Request $request,
        TicketsService $service,
        UserService $userService
    )
    {
        return new TicketResource($service->ticketDetails($request->route('ticket')));
    }
}
