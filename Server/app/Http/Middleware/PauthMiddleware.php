<?php namespace SpreadOut\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\Input;
use SpreadOut\Exceptions\ApiException;
use SpreadOut\Repositories\UserContract;

class PauthMiddleware implements Middleware {

    /**
     * @var UserContract
     */
    private $user;

    /**
     * @param UserContract $user
     */
    public function __construct(UserContract $user)
	{
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @throws ApiException
     * @return mixed
     */
	public function handle($request, Closure $next)
	{
        $token = $request->headers->get('Auth-Token');

        if (Input::has('token'))
        {
            $token = Input::get('token');
        }

        if ($this->user->findByToken($token))
        {
            throw new ApiException('You must provide a valid token. Come on, it\'t free.');
        }

		return $next($request);
	}

}
