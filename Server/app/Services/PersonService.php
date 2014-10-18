<?php namespace SpreadOut\Services;

use SpreadOut\Exceptions\ApiException;
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
     * @throws ApiException
     * @return mixed
     */
    public function create($data)
    {
        $data['type'] = 'company';

        // Creates the credentials
        $user = $this->user->create($data);

        $data['user_id'] = $user['id'];

        // Creates the profile
        $person = $this->person->create($data);

        if ( ! $person)
        {
            throw new ApiException('Server error !', 500);
        }

        $person['user'] = $user;

        return $person;
    }

    /**
     * @param $token
     * @throws ApiException
     * @return mixed
     */
    public function login($token)
    {
        $user = $this->token->findByToken($token);

        if ( ! $user)
        {
            throw new ApiException('Authentication failed. Wrong user token provided !', 422);
        }

        return $user;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ApiException
     */
    public function token(array $data)
    {
        $user = $this->person->findByCredentials($data['email'], $data['password']);

        if ( ! $user)
        {
            throw new ApiException('Invalid login data !', 422);
        }

        $this->token->delete($user['id']);

        $token = $this->token->create([
            'user_id' => $user['id'],
            'token'   => str_random(40),
            'type'    => 'person'
        ]);

        $user['token'] = $token['token'];

        return $user;
    }
}