<?php namespace SpreadOut\Repositories\Eloquent;

use Carbon\Carbon;
use SpreadOut\Event;
use SpreadOut\Repositories\EventContract;

class EventRepository extends AbstractRepository implements EventContract {

    /**
     * @param Event $model
     */
    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    /**
     * Create new event for the ticket
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $event = $this->getNew();
        $event->ticket_id = $data['ticket_id'];
        $event->date = Carbon::now()->toDateTimeString();
        $event->status = $data['status'];
        $event->save();

        return $this->toArray($event);
    }
}