<?php

namespace App\Http\Livewire\Maximums;

use App\Models\MreExcercise;
use App\Models\MaximumRep;
use Livewire\Component;

class MaximumReps extends Component
{

    public $mreExcercise, $maxReps;
    public $maxRepEdit, $weight, $date, $note, $openEdit = false;
    public $openSave = false;

    protected $listeners = ['delete'];

    public function mount(MreExcercise $mreExcercise){
        $this->user = auth()->user();
        $this->date = date('Y-m-d');
        $this->mreExcercise = $mreExcercise;
        $this->maxReps = MaximumRep::where('user_id', $this->user->id)->where('mre_excercise_id', $mreExcercise->id)->orderBy('date', 'desc')->orderBy('weight', 'desc')->get();
    }

    public function editMaxRep(MaximumRep $maximumRep){
        $this->maxRepEdit = $maximumRep;
        $this->weight = $maximumRep->weight;
        $this->date = $maximumRep->date;
        $this->note = $maximumRep->note;
        $this->openEdit = true;
    }

    public function update(){
        $this->validate([
            'weight' => 'numeric|min:0',
            'date' => 'date'
        ]);

        $this->maxRepEdit->weight = $this->weight;
        $this->maxRepEdit->date = $this->date;
        $this->maxRepEdit->note = $this->note;
        $this->maxRepEdit->save();
        $this->reset(['openEdit', 'weight', 'date', 'note', 'maxRepEdit']);
        $this->mount($this->mreExcercise);
        $this->emitSelf('saved');
    }

    public function hideEditModal(){
        $this->reset(['openEdit', 'weight', 'date', 'note', 'maxRepEdit']);
    }

    public function save(){
        $this->validate([
            'weight' => 'numeric|min:0',
            'date' => 'date'
        ]);

        $maxRep = new MaximumRep();
        $maxRep->user_id = auth()->user()->id;
        $maxRep->mre_excercise_id = $this->mreExcercise->id;
        $maxRep->weight = $this->weight;
        $maxRep->date = $this->date;
        $maxRep->note = $this->note;
        $maxRep->save();

        $this->openSave = false;
        $this->reset(['weight', 'date', 'note']);
        $this->mount($this->mreExcercise);
        $this->emitSelf('saved');
    }

    public function delete(MaximumRep $maximumRep){
        $maximumRep->delete();
        $this->mount($this->mreExcercise);
        $this->emitSelf('saved');
    }

    public function render(){
        return view('livewire.maximums.maximum-reps');
    }
}
