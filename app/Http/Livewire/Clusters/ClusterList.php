<?php

namespace App\Http\Livewire\Clusters;

use Livewire\Component;
use App\Models\Cluster;
use App\Models\Workout;
use App\Models\User;
use App\Models\Excercise;

class ClusterList extends Component{


    public $workout, $clusters;
    // Editar un cluster
    public $excercises, $clusterEdit, $nameEdit, $setsEdit, $repsEdit, $weightEdit, $clusterNoteEdit;
    public $open = false;

    protected $listeners = ['mount', 'deleteCluster', 'updateCluster'];

    public $rules = [
        'nameEdit' => 'required',
        'setsEdit' => 'required|numeric|min:1',
        'repsEdit' => 'required|numeric|min:1',
        'weightEdit' => 'numeric',
    ];

    public function mount(Workout $workout){
        // Get Workout
        $this->workout = $workout;
        // Get Clusters
        $this->clusters = Cluster::where('workout_id', $this->workout->id)->get();
        // Obtener ejercicios que usar
        $admin = User::where('role', 'admin')->first(); // ->value('id') no está funcionando en producción
        $this->adminId = $admin->id;
        $this->excercises = Excercise::where('user_id', $this->adminId)->orWhere('user_id', auth()->user()->id)->get();
    }

    // Identify cluster to update
    public function editCluster(Cluster $cluster){
        $this->clusterEdit = $cluster;
        $this->nameEdit = $cluster->excercise_name;
        $this->setsEdit = $cluster->sets;
        $this->repsEdit = $cluster->reps;
        $this->weightEdit = $cluster->weight;
        $this->clusterNoteEdit = $cluster->note;
        $this->open = true;
    }

    // Update changes on clusterEdit
    public function updateCluster(){
        // Validate data
        $this->validate();
        // Set new values
        $this->clusterEdit->excercise_name = $this->nameEdit;
        $this->clusterEdit->sets = $this->setsEdit;
        $this->clusterEdit->reps = $this->repsEdit;
        $this->clusterEdit->weight = $this->weightEdit;
        $this->clusterEdit->note = $this->clusterNoteEdit;


        $excercise = Excercise::where('name', $this->nameEdit)->first();
        if(is_object($excercise)){
            $this->clusterEdit->excercise_id = $excercise->id;
        }else{
            $this->clusterEdit->excercise_id = null;
        }
        // Save
        $this->clusterEdit->update();

        // Refresh
        $this->emitSelf('mount', $this->workout);
        $this->reset(['open', 'nameEdit', 'setsEdit', 'repsEdit', 'weightEdit', 'clusterNoteEdit', 'clusterEdit']);
    }

    public function hideEditModal(){
        $this->reset(['open', 'nameEdit', 'setsEdit', 'repsEdit', 'weightEdit', 'clusterNoteEdit', 'clusterEdit']);
    }

    // Delete cluster
    public function deleteCluster(Cluster $cluster){
        $cluster->delete();
        $this->emitSelf('mount', $this->workout);
    }

    public function render(){
        return view('livewire.clusters.cluster-list');
    }
}
