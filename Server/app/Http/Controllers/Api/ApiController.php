<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use SpreadOut\Repositories\UserContract;

class ApiController extends Controller {

    /**
     * Get authenticated user
     *
     * @return mixed
     */
    public function user()
    {
        return app('user');
    }
}