<?php namespace SpreadOut\Repositories;

interface CompanyContract {

    /**
     * Create a new user
     *
     * @param array $data
     * @return mixed
     */

    public function create(array $data);
    /**
     * Search for companies by name
     *
     * @param array $data
     * @return mixed
     */

    public function search(array $data);
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