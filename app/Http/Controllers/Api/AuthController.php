<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use SpreadOut\Http\Requests\Auth\PersonLoginRequest;
use SpreadOut\Http\Requests\Auth\PersonRegisterRequest;
use SpreadOut\Services\PersonService;

class AuthController extends Controller {

    /**
     * Person service
     *
     * @var PersonService
     */
    private $person;

    /**
     * @param PersonService $person
     */
    public function __construct(PersonService $person)
    {
        $this->person = $person;
    }

    /**
     * @param PersonLoginRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function personToken(PersonLoginRequest $request)
    {
        $input = Input::all();

        return $this->person->token($input);
    }

    /**
     * @param PersonRegisterRequest $request
     * @return mixed
     */
    public function registerPerson(PersonRegisterRequest $request)
    {
        $data = Input::all();

        $person = $this->person->create($data);

        return $person;
    }
}