<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\Repositories\TicketContract;
use SpreadOut\Ticket;

class TicketRepository extends AbstractRepository implements TicketContract {

    /**
     * @param Ticket $model
     */
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    /**
     * Create tags
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $ticket = $this->getNew();
        $ticket->title = $data['title'];
        $ticket->type = $data['type'];
        $ticket->description = $data['description'];
        $ticket->status = 'opened';
        $ticket->save();

        return $this->toArray($ticket);
    }

    /**
     *
     *
     * @param $id
     * @return bool
     */
    public function find($id)
    {
        return $this->toArray($this->with('events')->where('id', $id)->get());
    }

    /**
     * Get all the tags
     *
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return $this->toArray($this->model->with('events')->get());
    }
}