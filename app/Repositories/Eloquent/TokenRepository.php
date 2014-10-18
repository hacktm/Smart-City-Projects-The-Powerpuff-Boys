<?php namespace SpreadOut\Repositories\Eloquent;

use Carbon\Carbon;
use SpreadOut\Repositories\TokenContract;
use SpreadOut\Token;

class TokenRepository extends AbstractRepository implements TokenContract {

    /**
     * @param Company|Token $model
     */
    public function __construct(Token $model)
    {
        $this->model = $model;
    }

    /**
     * @param $token
     * @return bool
     */
    public function findByToken($token)
    {
        return $this->toArray($this->model->where('token', $token)->first());
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $token = $this->getNew();

        $token->user_id = $data['user_id'];
        $token->token = $data['token'];
        $token->type = $data['type'];
        $token->expiration = Carbon::now();
        $token->save();

        return $this->toArray($token);
    }
}