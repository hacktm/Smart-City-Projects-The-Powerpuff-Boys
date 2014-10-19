<?php namespace SpreadOut\Services;

use SpreadOut\Exceptions\ApiException;
use SpreadOut\Repositories\TicketContract;

class TicketService {

    /**
     * @var TicketContract
     */
    private $ticket;

    /**
     * @param TicketContract $ticket
     */
    public function __construct(TicketContract $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Create person and his username
     *
     * @param $data
     * @throws ApiException
     * @return mixed
     */
    public function create($data)
    {
        dd($data);
        $ticket = $this->ticket->create($data);

       return $data;
    }
}