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
}