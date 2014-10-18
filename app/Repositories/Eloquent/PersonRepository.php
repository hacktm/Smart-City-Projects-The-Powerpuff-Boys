<?php namespace SpreadOut\Repositories\Eloquent;

use Illuminate\Support\Facades\Hash;
use SpreadOut\Person;
use SpreadOut\Repositories\PersonContract;
use SpreadOut\User;

class PersonRepository extends AbstractRepository implements PersonContract {
    /**
     * @var User
     */
    private $user;

    /**
     * @param Person $model
     * @param User $user
     * @internal param Token $token
     */
    public function __construct(Person $model, User $user)
    {
        $this->model = $model;
        $this->user = $user;
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function findByCredentials($email, $password)
    {
        $user = $this->user->with('person')->where('email', $email)->first();

        if ( ! $user) return false;

        if (Hash::check($password, $user->password))
        {
            return $this->toArray($user);
        }

        return false;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $person = $this->getNew();
        $person->user_id = $data['user_id'];
        $person->firstname = $data['firstname'];
        $person->lastname = $data['lastname'];
        $person->save();

        return $this->toArray($person);
    }

    /**
     * Find user by id
     *
     * @param $id
     * @return bool
     */
    public function findById($id)
    {
        return $this->toArray($this->model->with('user')->where('user_id', $id)->get());
    }

    /**
     * Get all person
     *
     * @return bool
     */
    public function all()
    {
        return $this->toArray($this->model->with('user')->get());
    }
}