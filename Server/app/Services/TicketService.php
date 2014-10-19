<?php namespace SpreadOut\Services;

use SpreadOut\Exceptions\ApiException;
use SpreadOut\Repositories\EventContract;
use SpreadOut\Repositories\TicketContract;

class TicketService {

    /**
     * @var TicketContract
     */
    private $ticket;
    /**
     * @var EventContract
     */
    private $event;

    /**
     * @param TicketContract $ticket
     * @param EventContract $event
     */
    public function __construct(TicketContract $ticket, EventContract $event)
    {
        $this->ticket = $ticket;
        $this->event = $event;
    }

    /**
     * Create a new ticket
     *
     * @param $data
     * @throws ApiException
     * @return mixed
     */
    public function create($person, $data)
    {
        $data['person_id'] = $person;

        $ticket = $this->ticket->create($data);

        $data = $this->event->create([
            'ticket_id' => $ticket['id'],
            'status' => 'opened'
        ]);

       return $data;
    }
}