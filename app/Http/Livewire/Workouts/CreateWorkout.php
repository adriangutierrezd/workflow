<?php

namespace App\Http\Livewire\Workouts;

use Livewire\Component;
use App\Models\Workout;

class CreateWorkout extends Component
{
    public $workout;

    protected $listeners = ['saved'];

    public function mount(Workout $workout){
        // Get workout
        $this->workout = $workout;
    }

    public function render()
    {
        return view('livewire.workouts.create-workout');
    }
}
