<?php namespace SpreadOut\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * The root namespace to assume when generating URLs to actions.
	 *
	 * @var string
	 */
	protected $rootUrlNamespace = 'SpreadOut\Http\Controllers';

	/**
	 * The controllers to scan for route annotations.
	 *
	 * @var array
	 */
	protected $scan = [
		'SpreadOut\Http\Controllers\HomeController',
		'SpreadOut\Http\Controllers\Auth\AuthController',
		'SpreadOut\Http\Controllers\Auth\PasswordController',
	];

	/**
	 * Called before routes are registered.
	 *
	 * Register any model bindings or pattern based filters.
	 *
	 * @param  Router  $router
	 * @return void
	 */
	public function before(Router $router)
	{
		//
	}

	/**
	 * Define the routes for the application.
	 *
	 * @return void
	 */
	public function map(Router $router)
	{
		// require app_path('Http/routes.php');
	}

}
