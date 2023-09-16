<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('api-company')->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50', 'unique:products,name,NULL,id,company_id,' . Auth::guard('api-company')->id()],
            'description' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
            'price' => ['required', 'numeric', 'between:0,999.99'],
            'active' => ['nullable', 'boolean'],
            'cost' => ['required', 'numeric', 'between:0,999.99'],
            'stock' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
