<?php namespace SpreadOut\Services;

use Illuminate\Support\Facades\Hash;
use SpreadOut\Repositories\PersonContract;
use SpreadOut\Repositories\TokenContract;
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
     * @var TokenContract
     */
    private $token;

    /**
     * @param UserContract $user
     * @param PersonContract $person
     * @param TokenContract $token
     */
    public function __construct(UserContract $user, PersonContract $person, TokenContract $token)
    {
        $this->user = $user;
        $this->person = $person;
        $this->token = $token;
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

    /**
     * @param $token
     * @return mixed
     */
    public function login($token)
    {
        return $this->token->findByToken($token);
    }

    /**
     * Generate token
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function token(array $data)
    {
        $user = $this->person->findByCredentials($data['email'], $data['password']);

        if ( ! $user)
        {
            throw new \Exception('Invalid login data !');
        }

        $token = $this->token->create([
            'user_id' => $user['id'],
            'token'   => str_random(40),
            'type'    => 'person'
        ]);

        return $token;
    }
}