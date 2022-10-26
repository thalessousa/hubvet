<?php

namespace App\Http\Requests;

class SectorRequest extends BaseRequest
{
    public function __construct()
    {
        $this->model = 'sectors';
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
            'aisle' => 'string',
            'store_id' => 'required|exists:stores,id',
        ];
    }
}