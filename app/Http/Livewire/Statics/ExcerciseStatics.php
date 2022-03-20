<?php

namespace App\Http\Livewire\Statics;

use Livewire\Component;
use App\Models\Excercise;

class ExcerciseStatics extends Component{

    public $excercise, $excercise_name, $start_date, $end_date;

    public function mount(Excercise $excercise){
        $this->end_date = date('Y-m-d');
        $this->start_date = date("Y-m-d",strtotime($this->end_date."- 3 month"));
        $this->excercise = $excercise;
        $this->excercise_id = $excercise->id;
        $this->excercise_name = $excercise->name;
    }

    public function render(){
        return view('livewire.statics.excercise-statics');
    }
}
