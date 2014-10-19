<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use SpreadOut\Http\Requests\BranchRequest;
use SpreadOut\Services\TicketService;

class TicketController extends ApiController {
    /**
     * @var TicketService
     */
    private $ticket;

    /**
     * @param TicketService $ticket
     */
    public function __construct(TicketService $ticket)
    {
        $this->middleware('auth');

        $this->ticket = $ticket;
    }

    /**
     * Creates a ticket
     *
     * @param BranchRequest $request
     * @return mixed
     * @throws \SpreadOut\Exceptions\ApiException
     */
    public function create(BranchRequest $request)
    {
        $input = Input::all();

        return $this->ticket->create($this->user()['id'], $input);
    }
}