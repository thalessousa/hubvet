<?php

namespace App\Http\Requests;

class UserRequest extends BaseRequest
{
    public function __construct()
    {
        $this->model = 'users';
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
