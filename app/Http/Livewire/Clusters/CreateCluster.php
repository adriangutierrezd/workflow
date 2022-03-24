<?php

namespace App\Http\Livewire\Clusters;

use Livewire\Component;
use App\Models\User;
use App\Models\Excercise;
use App\Models\Workout;
use App\Models\Cluster;

class CreateCluster extends Component{

    public $workout;
    // Crear un cluster
    public $excercises, $name, $sets, $excercise_id, $reps, $weight = 0, $clusterNote;

    // Validaciones
    public $rules = [
        'name' => 'required',
        'sets' => 'required|numeric|min:1',
        'reps' => 'required|numeric|min:1',
        'weight' => 'numeric',
    ];

    public function mount(Workout $workout){
        // Get workout
        $this->workout = $workout;

        // Obtener ejercicios que usar
        $admin = User::where('role', 'admin')->first(); // ->value('id') no está funcionando en producción
        $this->adminId = $admin->id;
        $this->excercises = Excercise::where('user_id', $this->adminId)->orWhere('user_id', auth()->user()->id)->get();
    }

    // Create cluster
    public function createCluster(){

        // Validate
        $this->validate();

        // Create cluster and insert data
        $cluster = new Cluster();
        $cluster->user_id = auth()->user()->id;
        $cluster->workout_id = $this->workout->id;
        $cluster->excercise_name = $this->name;
        $cluster->sets = $this->sets;
        $cluster->reps = $this->reps;
        $cluster->weight = $this->weight;
        $cluster->note = $this->clusterNote;

        $excercise = Excercise::where('name', $this->name)->first();
        if(is_object($excercise)){
            $cluster->excercise_id = $excercise->id;
        }else{
            $cluster->excercise_id = null;
        }
        
        // Save data
        $cluster->save();
        $this->reset(['name', 'sets', 'excercise_id', 'reps', 'weight', 'clusterNote']);
        $this->emitTo('clusters.cluster-list', 'mount', $this->workout);
        
    }

    public function render(){
        return view('livewire.clusters.create-cluster');
    }
}
