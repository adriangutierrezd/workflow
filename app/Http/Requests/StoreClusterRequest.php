<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClusterRequest extends FormRequest
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
        return [
            'user_id' => 'integer|exists:users,id',
            'workout_id' => 'required|integer|exists:workouts,id',
            'excercise_id' => 'required|integer|exists:excercises,id',
            'reps' => 'required|integer|min:1',
            'sets' => 'required|integer|min:1',
            'weight' => 'required|min:0',
            'done' => 'boolean',
            'units' => 'string'
        ];
    }
}
