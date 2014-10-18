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

    /**
     * Attach tag to a company
     *
     * @param array $data
     * @return mixed
     */
    public function attachTag(array $data);

    /**
     * Detach tag from a company
     *
     * @param array $data
     * @return mixed
     */
    public function detachTag(array $data);
}