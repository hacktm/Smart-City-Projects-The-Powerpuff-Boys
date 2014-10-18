<?php namespace SpreadOut\Services;

use SpreadOut\Repositories\PersonContract;
use SpreadOut\Repositories\UserContract;

class PersonService {
    /**
     * @var UserContract
     */
    private $user;
    /**
     * @var PersonContract
     */
    private $person;

    /**
     * @param UserContract $user
     */
    public function __construct(UserContract $user, PersonContract $person)
    {
        $this->user = $user;
        $this->person = $person;
    }

    /**
     * Create person and his username
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $user = $this->user->create($data);

        $data['user_id'] = $user['id'];

        $person = $this->person->create($data);
        $person['user'] = $user;

        return $person;
    }

    public function token($username, $password)
    {
        $user = $this->user->findByCredentials($email, $password);

        var_dump($user);
    }
}