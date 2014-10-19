<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
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

    public function create()
    {
        $input = Input::all();

        return $this->ticket->create($this->user()['id'], $input);
    }
}