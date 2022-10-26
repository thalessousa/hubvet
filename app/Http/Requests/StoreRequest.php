<?php

namespace App\Http\Requests;

class StoreRequest extends BaseRequest
{
    public function __construct()
    {
        $this->model = 'stores';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max: 255',
            'description' => 'string',
            'type' => 'string',
        ];
    }
}