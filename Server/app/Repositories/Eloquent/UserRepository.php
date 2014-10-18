<?php namespace SpreadOut\Repositories\Eloquent;

use Illuminate\Support\Facades\Hash;
use SpreadOut\Repositories\UserContract;
use SpreadOut\User;

class UserRepository extends AbstractRepository implements UserContract {

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $user = $this->getNew();
        $user->password = $data['password'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->type = $data['type'];
        $user->save();

        return $this->toArray($user);
    }


    /**
     * Find user by id
     *
     * @param $id
     * @return bool|mixed
     */
    public function findById($id)
    {
        return $this->toArray($this->model->find($id));
    }

    /**
     * Find user by email
     *
     * @param $email
     * @return bool|mixed
     */
    public function findByEmail($email)
    {
        return $this->toArray($this->model->where('email', $email)->first());
    }

}