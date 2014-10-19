<?php namespace SpreadOut\Repositories;

interface TicketContract {

    /**
     * Create ticket
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Get all the tags
     *
     * @return mixed
     */
    public function all();
}