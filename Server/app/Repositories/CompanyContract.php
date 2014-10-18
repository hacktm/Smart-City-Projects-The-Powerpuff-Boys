<?php namespace SpreadOut\Repositories;

interface CompanyContract {

    /**
     * Find company by cui
     *
     * @param $cui
     * @return mixed
     */
    public function findByCUI($cui);

    /**
     * Find company by name
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name);
}