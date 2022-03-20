<?php

namespace App\Http\Livewire\Workouts;

use Livewire\Component;
use App\Models\Workout;
use Livewire\WithPagination;

class Workouts extends Component{

    use WithPagination;


    public $workouts;
    public $filter = 'week';

    protected $listeners = ['delete', 'render'];

    
    public function mount(){
        if($this->filter == 'week'){
            $this->workouts = Workout::where('user_id', auth()->user()->id)
            ->where('date', '>=', now()->subDays(7))->orderBy('date', 'desc')
            ->get();
        }elseif($this->filter == 'month'){
            $this->workouts = Workout::where('user_id', auth()->user()->id)
            ->where('date', '>=', now()->subDays(30))->orderBy('date', 'desc')
            ->get();
        }elseif($this->filter == 'year'){
            $this->workouts = Workout::where('user_id', auth()->user()->id)
            ->where('date', '>=', now()->subDays(365))->orderBy('date', 'desc')
            ->get();
        }elseif($this->filter == 'all'){
            $this->workouts = Workout::where('user_id', auth()->user()->id)->orderBy('date', 'desc')
            ->get();
        }
    }

    public function updatedFilter($value){
        $this->filter = $value;
        $this->mount();
    }


    public function create(){
        // Creamos el entrenamiento
        $workout = new Workout();
        $workout->user_id = auth()->user()->id;
        $workout->save();
        // Regirigimos y pasamos los datos
        return redirect()->route('workouts.create', compact('workout'));
    }

    public function delete(Workout $workout){
        $workout->delete();
        $this->emit('saved');
        $this->emit('render');
    }

    public function render(){
        return view('livewire.workouts.workouts');
    }
}
