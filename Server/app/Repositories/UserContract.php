<?php namespace SpreadOut\Repositories;

interface UserContract {


    /**
     * Create user for persons or companies
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Find user by his id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Find user by token
     *
     * @param $token
     * @return mixed
     */
    public function findByToken($token);

    /**
     * Find user by his email
     *
     * @param $email
     * @return mixed
     */
    public function findByEmail($email);
}