<?php namespace SpreadOut\Repositories;

interface UserContract {

    /**
     * Find user by his id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Find user by his email
     *
     * @param $email
     * @return mixed
     */
    public function findByEmail($email);
}