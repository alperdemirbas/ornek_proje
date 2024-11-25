<?php

namespace Rezyon\Applications\Tickets\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Rezyon\Applications\Tickets\Http\Requests\TicketReadRequest;
use Rezyon\Supplier\Services\ActivityService;
use Rezyon\Tickets\Services\TicketsService;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        return view('applications.tickets::ticket');
    }

    public function read(
        TicketReadRequest $request,
        TicketsService $ticketsService,
        ActivityService $activityService
    )
    {
        $ticket = $ticketsService->getById($request->input('id'));
        DB::beginTransaction();
        try {
            $ticketsService->useTicket($ticket->id, $request->user()->id);
            $activityService->setParticipants($ticket->activity_id, $ticket->owner_id);
            DB::commit();
            return response()->json($ticket->activity->name);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 400);
        }
    }
}
