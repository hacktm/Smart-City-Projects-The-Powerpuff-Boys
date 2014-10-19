<?php namespace SpreadOut\Http\Controllers;

use Illuminate\Routing\Controller;
/**
 * @Middleware("auth")
 */
class HomeController extends Controller {

    public function __construct()
    {
    }


    /**
     * @Get("/")
     */
	public function index()
	{
        return '<h1>Welcome to SpreadOut !</h1>';
	}

}
