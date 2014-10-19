<?php namespace SpreadOut\Repositories;

interface EventContract {

    /**
     * Create a new event for a ticket
     *
     * @param array $create
     * @return mixed
     */
    public function create(array $create);
}