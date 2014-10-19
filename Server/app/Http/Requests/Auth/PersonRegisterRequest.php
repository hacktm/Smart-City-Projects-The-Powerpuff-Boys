<?php namespace SpreadOut\Http\Requests\Auth;

use SpreadOut\Http\Requests\BaseFormRequest;

class PersonRegisterRequest extends BaseFormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => 'required|email|unique:users',
			'password' => 'required|min:4',
            'phone' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
