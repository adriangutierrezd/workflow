<?php

namespace App\Http\Livewire\ExcerciseCategories;

use Livewire\Component;
use App\Models\ExcerciseCategory;
use Illuminate\Validation\Rule;

class ExcerciseCategories extends Component
{

    protected $listeners = ['mount','delete'];

    public $name, $open = false;
    public $categories;
    public $categoryEdit, $nameEdit;

    public function mount(){
        // Obtener las categorías
        $this->categories = ExcerciseCategory::all();
    }

    public function create(){
        $this->validate([
            'name' => 'required|unique:excercise_categories,name'
        ]);

        $excerciseCategory = new ExcerciseCategory();
        $excerciseCategory->name = $this->name;
        $excerciseCategory->save();
        $this->reset('name');
        $this->emitSelf('saved');
        $this->emit('mount');

    }

    public function delete(ExcerciseCategory $category){
        $category->delete();
        $this->emitSelf('saved');
        $this->emit('mount');
    }

    public function edit(ExcerciseCategory $categoryEdit){
        $this->categoryEdit = $categoryEdit;
        $this->nameEdit = $categoryEdit->name;
        $this->open = true;
    }

    public function update(){

        $categoryEdit = $this->categoryEdit;
        $this->validate([
            'nameEdit' => ['required', Rule::unique('excercise_categories', 'name')->ignore($categoryEdit->id)],
        ]);
        $this->categoryEdit->name = $this->nameEdit;
        $this->categoryEdit->save();
        $this->reset(['open', 'nameEdit', 'categoryEdit']);
        $this->emitSelf('saved');
        $this->mount();
    }

    public function hideEditModal(){
        $this->reset(['open', 'nameEdit', 'categoryEdit']);
    }


    public function render(){
        return view('livewire.excercise-categories.excercise-categories');
    }
}
