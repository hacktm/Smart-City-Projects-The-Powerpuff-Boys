<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use SpreadOut\Repositories\UserContract;

class ApiController extends Controller {

    public function __construct(UserContract $user)
    {
        var_dump($this->user->token('ionutxp', 'parola'));
    }
}