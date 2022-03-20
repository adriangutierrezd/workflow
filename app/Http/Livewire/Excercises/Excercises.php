<?php

namespace App\Http\Livewire\Excercises;

use Livewire\Component;
use App\Models\Excercise;
use App\Models\ExcerciseCategory;
use App\Models\User;
use Illuminate\Validation\Rule;

class Excercises extends Component
{


    protected $listeners = ['render', 'delete'];
    public $categories, $name, $category = "",  $open = false;
    public $adminId, $excercises;
    public $editExcercise, $nameEdit, $categoryEdit;
    public $search;



    public function mount(){
        // Get categories
        $this->categories = ExcerciseCategory::all();     
        $admin = User::where('role', 'admin')->first(); // ->value('id') no está funcionando en producción
        $this->adminId = $admin->id;

        $this->excercises = Excercise::where(function($query){
                $query->where('name', 'LIKE', '%'. $this->search . '%')->where('user_id', auth()->user()->id);
            })
            ->orWhere(function($query) {
                $query->where('name', 'LIKE', '%'. $this->search . '%')->where('user_id', $this->adminId);
            })
        ->get();

    }

    public function updatedSearch($value){
        $this->search = $value;
        $this->excercises = Excercise::where(function($query){
            $query->where('name', 'LIKE', '%'. $this->search . '%')->where('user_id', auth()->user()->id);
        })
        ->orWhere(function($query) {
            $query->where('name', 'LIKE', '%'. $this->search . '%')->where('user_id', $this->adminId);
        })->get();
    }

    public function create(){
        $this->validate([
            'name' => 'required|unique:excercises,name|min:2',
            'category' => 'required'
        ]);

        $excercise = new Excercise();
        $excercise->user_id = auth()->user()->id;
        $excercise->name = $this->name;
        $excercise->excercise_category_id = $this->category;

        $excercise->save();
        $this->reset(['name', 'category']);
        $this->emit('saved');
        $this->mount();
    }

    public function edit(Excercise $excercise){
        $this->editExcercise = $excercise;
        $this->nameEdit = $excercise->name;
        $this->categoryEdit = $excercise->excercise_category_id;
        $this->open = true;
    }

    public function hideEditModal(){
        $this->reset(['open', 'nameEdit', 'categoryEdit', 'editExcercise']);
    }

    public function update(){
        $editExcercise = $this->editExcercise;
        $this->validate([
            'nameEdit' => ['required', Rule::unique('excercises', 'name')->ignore($editExcercise->id)],
            'categoryEdit' => ['required']
        ]);

        $this->editExcercise->name = $this->nameEdit;
        $this->editExcercise->excercise_category_id = $this->categoryEdit;

        $this->editExcercise->save();
        $this->reset(['open', 'nameEdit', 'categoryEdit', 'editExcercise']);
        $this->emit('saved');
        $this->mount();
    }

    public function delete(Excercise $excercise){
        $excercise->delete();
        $this->emit('saved');
        $this->emit('render');
    }

    public function render(){
        return view('livewire.excercises.excercises');
    }
}
