<?php namespace SpreadOut\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use SpreadOut\Services\PersonService;

class AuthMiddleware implements Middleware {

    /**
     * @var PersonService
     */
    private $person;

    public function __construct(PersonService $person)
	{
        $this->person = $person;
    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $token = $request->headers->get('Auth-Token');

        if (Input::has('x-token'))
        {
            $token = Input::has('x-token');
        }
        
        $user = $this->person->login($token);

        // Store the user in the ioc Container
        $app = app();
        $app['user'] = $user;

		return $next($request);
	}

}
