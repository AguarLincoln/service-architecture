<?php

namespace App\Http\Requests\Category;

use App\Enum\Filters\Category\OrderBy;
use App\Enum\Filters\Category\SearchType;
use App\Enum\Filters\OrderByType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): ?Model
    {
        return Auth::guard('api-company')->user();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'order_by' => ['nullable', 'string', 'max:255', Rule::enum(OrderBy::class)],
            'order_by_type' => [Rule::requiredIf(!!$this->get('order_by')), 'string', 'max:4', Rule::enum(OrderByType::class)],
            'search_by' => ['nullable', 'string', 'max:255'],
            'search_type' => [Rule::requiredIf(!!$this->get('search_by')), 'string', 'max:50', Rule::enum(SearchType::class)]
        ];
    }
}
