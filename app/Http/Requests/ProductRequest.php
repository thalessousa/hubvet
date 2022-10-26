<?php

namespace App\Http\Requests;

class ProductRequest extends BaseRequest
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
            'price' => 'required|double',
            'stock' => 'required|string',
            'supplier' => 'string',
            'store_id' => 'required|exists:stores,id',
            'sector_id' => 'required|exists:sectors,id',
        ];
    }
}