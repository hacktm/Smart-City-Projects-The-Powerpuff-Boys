<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use SpreadOut\Http\Requests\Auth\PersonLoginRequest;
use SpreadOut\Http\Requests\Auth\PersonRegisterRequest;
use SpreadOut\Services\CompanyService;
use SpreadOut\Services\PersonService;

class AuthController extends Controller {

    /**
     * Person service
     *
     * @var PersonService
     */
    private $person;
    /**
     * @var CompanyService
     */
    private $company;

    /**
     * @param PersonService $person
     * @param CompanyService $company
     */
    public function __construct(PersonService $person, CompanyService $company)
    {
        $this->person = $person;
        $this->company = $company;
    }

    /**
     * @param PersonLoginRequest $request
     * @return mixed
     */
    public function personToken(PersonLoginRequest $request)
    {
        $input = Input::all('loginName', 'password');

        return $this->person->token([
            'email'    => $input['loginName'],
            'password' => $input['password'],
        ]);
    }

    /**
     *
     */
    public function personLogout()
    {
        $token = Input::get('token');

        return $this->person->logout($token);
    }

    /**
     * @param PersonLoginRequest $request
     * @return mixed
     */
    public function companyToken(PersonLoginRequest $request)
    {
        $input = Input::all();

        return $this->company->token($input);
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