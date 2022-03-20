<?php

namespace App\Http\Livewire;

use Livewire\Component;


class ContactFormGuests extends Component{

    protected $listeners = ['store', 'render', 'enableButton'];

    public $name, $email, $message, $policy = false;
    public $disabled = true;


    public $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:10',
        'policy' => 'required'
    ];

    public function store(){

        $rules = $this->rules;
        $this->validate($rules);
        
        $this->reset(['name', 'email', 'message', 'policy']);
        session()->flash('flash.banner', '¡Hemos recibido tu mensaje, te contestaremos lo antes posible!');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('home');
        
    }


    public function updatedName($value){
        $this->name = $value;
        $this->emitSelf('enableButton');
        $this->emitSelf('render');
        
    }

    public function updatedEmail($value){
        $this->email = $value;
        $this->emitSelf('enableButton');
        $this->emitSelf('render');
        
    }

    public function updatedMessage($value){
        $this->message = $value;
        $this->emitSelf('enableButton');
        $this->emitSelf('render');
        
    }

    public function updatedPolicy($value){
        $this->policy = $value;
        $this->emitSelf('enableButton');
        $this->emitSelf('render');
    }

    public function enableButton(){

        if(!empty($this->name) && !empty($this->email) && !empty($this->message)){
            if($this->policy == true){
                $this->disabled = false;
            }else{
                $this->disabled = true;
            }
        }else{
            $this->disabled = true;
        }


        $this->emitSelf('render');
    }

    public function render(){
        return view('livewire.contact-form-guests');
    }
}
