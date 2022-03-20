<?php

namespace App\Http\Livewire\Maximums;

use Livewire\Component;
use App\Models\Excercise;
use App\Models\User;
use App\Models\MreExcercise;
use App\Models\MaximumRep;

class Maximums extends Component{

    public $excercises, $mres, $open = false, $name, $openMaxRepModal = false;
    public $mrex, $weight, $date, $note = null;
    protected $listeners = ['delete'];
    public $search;

    public function mount(){
        $this->user = auth()->user();
        $this->date = date('Y-m-d');
        $this->mres = MreExcercise::where('user_id', $this->user->id)->get();
        $admin = User::where('role', 'admin')->first(); // ->value('id') no está funcionando en producción
        $this->adminId = $admin->id;
        $this->excercises = Excercise::where(function($query){
            $query->where('name', 'LIKE', '%'. $this->search . '%')->where('user_id', $this->user->id);
            })
            ->orWhere(function($query) {
                $query->where('name', 'LIKE', '%'. $this->search . '%')->where('user_id', $this->adminId);
            })
        ->get();
    }

    public function updatedSearch($value){
        $this->search = $value;
        $this->mres = MreExcercise::where(function($query){
            $query->where('name', 'LIKE', '%'. $this->search . '%')->where('user_id', auth()->user()->id);
        })
        ->orWhere(function($query) {
            $query->where('name', 'LIKE', '%'. $this->search . '%')->where('user_id', $this->adminId);
        })->get();
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'weight' => 'numeric|min:0',
            'date' => 'date'
        ]);

        // SAVE MRE EXCERCISE
        $mre = new MreExcercise();
        $mre->user_id = $this->user->id;
        $mre->name = $this->name;

        $excercise = Excercise::where('name', $this->name)->first();
        if(is_object($excercise)){
            $mre->excercise_id = $excercise->id;
        }else{
            $mre->excercise_id = null;
        }

        $mre->save();
        // SAVE RM
        $maxRep = new MaximumRep();
        $maxRep->user_id = $this->user->id;
        $maxRep->mre_excercise_id = $mre->id;
        $maxRep->weight = $this->weight;
        $maxRep->date = $this->date;
        $maxRep->note = $this->note;

        $maxRep->save();
        $this->reset(['name', 'weight', 'date', 'note']);
        
        $this->open = false;
        $this->mount();
        $this->emitSelf('saved');
    }

    public function delete(MreExcercise $mre){
        $mre->delete();
        $this->mount();
        $this->emitSelf('saved');
    }

    public function addMaxRep(MreExcercise $mre){
        $this->mrex = $mre;
        $this->openMaxRepModal = true;
    }

    public function saveMaxRep(){

        $this->validate([
            'weight' => 'numeric|min:0',
            'date' => 'date'
        ]);

        $maxRep = new MaximumRep();
        $maxRep->user_id = auth()->user()->id;
        $maxRep->mre_excercise_id = $this->mrex->id;
        $maxRep->weight = $this->weight;
        $maxRep->date = $this->date;
        $maxRep->note = $this->note;
        $maxRep->save();

        $this->reset(['weight', 'date', 'note']);

        $this->openMaxRepModal = false;
        $this->mount();
        $this->emitSelf('saved');
    }

    public function render(){
        return view('livewire.maximums.maximums');
    }
}
