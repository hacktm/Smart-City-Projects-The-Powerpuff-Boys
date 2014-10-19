<?php namespace SpreadOut\Repositories;

interface CountyContract {

    /**
     * Create a city
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Get all counties
     *
     * @return mixed
     */
    public function all();
}