<?php

namespace App\Http\Livewire\Statics;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Excercise;

class Statics extends Component{

    public $excercises, $search;

    public function mount(){
        // Sacar solo ejercicios que se hayan utilizado

        $this->excercises = DB::table('excercises')->where('name', 'LIKE', '%'. $this->search . '%')
            ->whereExists(function ($query) {
                $query->select('excercise_name')
                    ->from('clusters')
                    ->whereColumn('clusters.excercise_id', 'excercises.id')->where('user_id', auth()->user()->id);
        })->get();
    }


    public function updatedSearch($value){
        $this->search = $value;
        $this->excercises = DB::table('excercises')->where('name', 'LIKE', '%'. $this->search . '%')
        ->whereExists(function ($query) {
            $query->select('excercise_name')
                ->from('clusters')
                ->whereColumn('clusters.excercise_id', 'excercises.id')->where('user_id', auth()->user()->id);
        })->get();
    }

    public function render(){
        return view('livewire.statics.statics');
    }
}
