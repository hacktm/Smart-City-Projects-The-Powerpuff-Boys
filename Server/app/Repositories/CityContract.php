<?php namespace SpreadOut\Repositories;

interface CityContract {

    /**
     * Create a city
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
}