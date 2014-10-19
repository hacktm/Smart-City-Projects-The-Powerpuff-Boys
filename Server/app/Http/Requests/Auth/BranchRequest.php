<?php namespace SpreadOut\Http\Requests\Auth;

use SpreadOut\Http\Requests\BaseFormRequest;

class BranchRequest extends BaseFormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'branch_id'   => 'numeric',
            'type'        => 'required',
            'title'       => 'required',
            'description' => 'required'
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
