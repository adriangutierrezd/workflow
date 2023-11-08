<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClusterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return 
            auth()->check() 
            && ($this->user_id === auth()->user()->id || $this->owner_id === auth()->user()->id);
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
            'workout_id' => 'integer|exists:workouts,id',
            'excercise_id' => 'integer|exists:excercises,id',
            'reps' => 'integer|min:1',
            'sets' => 'integer|min:1',
            'weight' => 'min:0',
            'done' => 'boolean',
            'units' => 'string'
        ];
    }
}
