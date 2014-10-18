<?php namespace SpreadOut\Http\Controllers;

use Illuminate\Routing\Controller;
use SpreadOut\Exceptions\ApiException;

class HomeController extends Controller {

    public function __construct()
    {
    }

	/**
	 * @Get("/")
     * @Middleware("auth")
	 */
	public function index()
	{
        return '<h1>Welcome to SpreadOut !</h1>';
	}

}
