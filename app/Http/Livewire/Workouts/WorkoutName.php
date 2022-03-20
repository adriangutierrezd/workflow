<?php

namespace App\Http\Livewire\Workouts;

use Livewire\Component;
use App\Models\Workout;

class WorkoutName extends Component
{

    public $workout, $name;

    public function mount(Workout $workout){
        $this->workout = $workout;
        $this->name = $this->workout->name;
    }

    public function save(){
        $this->validate([
            'name' => 'required|min:2',
        ]);

        $this->workout->name = $this->name;
        $this->workout->save();
    }

    public function render()
    {
        return view('livewire.workouts.workout-name');
    }
}
