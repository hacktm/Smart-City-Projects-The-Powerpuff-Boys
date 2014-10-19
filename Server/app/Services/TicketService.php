<?php namespace SpreadOut\Services;

use SpreadOut\Exceptions\ApiException;
use SpreadOut\Repositories\BranchContract;
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
     * @var BranchContract
     */
    private $branch;

    /**
     * @param TicketContract $ticket
     * @param EventContract $event
     * @param BranchContract $branch
     */
    public function __construct(TicketContract $ticket, EventContract $event, BranchContract $branch)
    {
        $this->ticket = $ticket;
        $this->event = $event;
        $this->branch = $branch;
    }

    /**
     * Creates a new ticket
     *
     * @param $person
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function create($person, $data)
    {
        $branch = $this->branch->findById($data['branch_id']);

        if ( ! $branch)
        {
            throw new ApiException('This branch doesn\'t exists !');
        }

        $data['person_id'] = $person;
        $data['branch_id'] = $data['branch'];

        $ticket = $this->ticket->create($data);

        $data = $this->event->create([
            'ticket_id' => $ticket['id'],
            'status' => 'opened'
        ]);

       return $data;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function search(array $data)
    {
        return $this->ticket->search($data);
    }
}