<?php namespace SpreadOut\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller {

	/**
	 * @Get("/")
	 */
	public function index()
	{
        return '<h1>Welcome to SpreadOut !</h1>';
	}

}
