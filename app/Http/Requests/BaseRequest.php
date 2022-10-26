<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BaseRequest extends FormRequest
{
    protected $model;
    protected $mapped = [];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $permissions = [
            'GET' => 'read',
            'POST' => 'create',
            'PUT' => 'update',
            'DELETE' => 'delete',
        ];

        return Auth::user()->can($this->model . '.' . $permissions[$this->method()]);
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

    public function multiValidate(array $receptacles, array $validators)
    {
        array_map(
            fn ($index, $validator) => $this->mapped[$index] = $this->validate((new $validator())->rules()),
            $receptacles,
            $validators
        );
        return $this->mapped;
    }
}
