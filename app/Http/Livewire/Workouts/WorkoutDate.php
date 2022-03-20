<?php

namespace App\Http\Livewire\Workouts;

use Livewire\Component;
use App\Models\Workout;

class WorkoutDate extends Component
{
    public $workout, $date;

    public function mount(Workout $workout){
        $this->workout = $workout;
        $this->date = $this->workout->date;
    }

    public function save(){
        $this->validate([
            'date' => 'required|date|min:2',
        ]);

        $this->workout->date = $this->date;
        $this->workout->save();
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.workouts.workout-date');
    }
}
