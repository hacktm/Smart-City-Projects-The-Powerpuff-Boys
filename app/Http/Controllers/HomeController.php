<?php namespace SpreadOut\Http\Controllers;

use Illuminate\Routing\Controller;
use SpreadOut\Repositories\UserContract;

class HomeController extends Controller {

    public function __construct(UserContract $user)
    {
        // Test
        var_dump($user->findById(1));
    }

	/**
	 * @Get("/")
	 */
	public function index()
	{
        return '<h1>Welcome to SpreadOut !</h1>';
	}

}
