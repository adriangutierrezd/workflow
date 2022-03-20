<?php

namespace App\Http\Livewire\Workouts;

use Livewire\Component;
use App\Models\Workout;

class WorkoutNote extends Component{

    public $workout, $note;

    protected $rules = [
        'note' => 'required',
    ];

    public function mount(Workout $workout){
        $this->workout = $workout;
        $this->note = $this->workout->note;
    }

    public function save(){
        // Validate
        $this->validate();

        // Set and save data
        $this->workout->note = $this->note;
        $this->workout->save();
    }

    public function render(){
        return view('livewire.workouts.workout-note');
    }
}
