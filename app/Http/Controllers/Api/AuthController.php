<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use SpreadOut\Http\Requests\Auth\PersonRegisterRequest;
use SpreadOut\Services\PersonService;
use SpreadOut\Services\UserService;

class AuthController extends Controller {

    private $person;

    public function __construct(PersonService $person)
    {
        $this->person = $person;
    }

    public function personToken()
    {
        $input = Input::all();

        return $this->person->token($input);
    }

    public function registerPerson(PersonRegisterRequest $request)
    {
        $data = Input::all();

        $person = $this->person->create($data);

        return $person;
    }
}