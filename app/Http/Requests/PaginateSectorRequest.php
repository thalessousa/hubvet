<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PaginateSectorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('sectors.read');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sortedBy' => 'string|in:asc,desc',
            'orderBy' => 'string',
            'limit' => 'integer',
            'page' => 'integer',
        ];
    }
}
