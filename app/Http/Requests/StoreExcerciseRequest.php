<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExcerciseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = auth()->id();
    
        return [
            'name' => [
                'required',
                'max:100',
                Rule::unique('excercises', 'name')->where(function ($query) use ($userId) {
                    return $query->where('user_id', null)->orWhere('user_id', $userId);
                }),
            ],
        ];
    }
}
