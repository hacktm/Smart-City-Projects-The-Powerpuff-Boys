<?php namespace SpreadOut\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller {

    public function __construct()
    {
    }

	/**
	 * @Get("/")
     * #Middleware("auth")
	 */
	public function index()
	{
        return '<h1>Welcome to SpreadOut !</h1>';
	}

}
