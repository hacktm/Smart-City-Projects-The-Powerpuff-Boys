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
        $ticket->branch_id = $data['branch_id'];
        $ticket->person_id = $data['person_id'];
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
     * Search for a ticket
     *
     * @param array $data
     * @return bool
     */
    public function search(array $data)
    {
        $find = $this->model;

        if (isset($data['id']))
        {
            $find = $find->where('id', $data['id']);
        }

        if (isset($data['name']))
        {
            $find = $find->where('title', 'LIKE', '%'.$data['name'].'%');
        }

        if (isset($data['type']))
        {
            $find = $find->where('type', $data['type']);
        }

        if (isset($data['branch_id']))
        {
            $find = $find->where('branch_id', $data['branch_id']);
        }

        return $this->toArray($find->get());
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