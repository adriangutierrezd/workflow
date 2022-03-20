<?php

namespace App\Http\Livewire\Workouts;

use Livewire\Component;
use App\Models\Workout;

class EditWorkout extends Component
{

    public $workout;

    public function mount(Workout $workout){
        $this->workout = $workout;
    }


    public function render()
    {
        return view('livewire.workouts.edit-workout');
    }
}
