<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use SpreadOut\Services\TicketService;

class TicketController extends Controller {
    /**
     * @var TicketService
     */
    private $ticket;

    /**
     * @param TicketService $ticket
     */
    public function __construct(TicketService $ticket)
    {
        $this->ticket = $ticket;
    }

    public function create()
    {
        $input = Input::all();

        return $this->ticket->create($input);
    }
}