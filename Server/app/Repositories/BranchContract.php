<?php namespace SpreadOut\Repositories;

interface BranchContract {

    /**
     * Create a branch
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Search for a branch by name
     *
     * @param array $data
     * @return mixed
     */
    public function search(array $data);


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