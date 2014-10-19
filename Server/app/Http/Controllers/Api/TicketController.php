<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use SpreadOut\Http\Requests\Auth\BranchRequest;
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
     * Create a ticket
     *
     * @param BranchRequest $request
     * @throws \SpreadOut\Exceptions\ApiException
     * @return mixed
     */
    public function create(BranchRequest $request)
    {
        $input = Input::all();

        return $this->ticket->create($this->user()['id'], $input);
    }
}