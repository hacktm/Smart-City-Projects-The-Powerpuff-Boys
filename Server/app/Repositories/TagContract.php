<?php namespace SpreadOut\Repositories;

interface TagContract {

    /**
     * Create a tag
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Search for tags and their companies
     *
     * @param array $data
     * @return mixed
     */
    public function search(array $data);

    /**
     * Get all the tags
     *
     * @return mixed
     */
    public function all();
}