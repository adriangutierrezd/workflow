<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cookies extends Component{

    public $open;
    public $toggleNeeded = 1, $toggleMarketing, $toggleAdvertising;

    protected $listeners = ['openCookies'];


    public function mount(){
        if(!isset($_COOKIE['needed'])){
            $this->open = 1;
        }else{
            $this->open = 0;
        }

        if(isset($_COOKIE['marketing'])){
            $this->toggleMarketing = 1;
        }else{
            $this->toggleMarketing = 0;
        }

        if(isset($_COOKIE['adversiting'])){
            $this->toggleAdversiting = 1;
        }else{
            $this->toggleAdversiting = 0;
        }
    }

    public function saveCookies(){
        // Generamos cookie indicando que efectivamente, el usuario ha aceptado las cookies
        setcookie('needed', '1', time() + (86400 * 30), "/");

        // Custom cookies
        if(isset($_COOKIE['marketing'])){
            if($this->toggleMarketing == 0){
                setcookie('marketing', null ,-1, "/");
            }
        }else{
            if($this->toggleMarketing == 1){
                setcookie('marketing', '1', time() + (86400 * 30), "/");
            }
        }
        

        if(isset($_COOKIE['advertising'])){
            if($this->toggleAdvertising == 0){
                setcookie('advertising', null ,-1, "/");
            }
        }else{
            if($this->toggleAdvertising == 1){
                setcookie('advertising', '1', time() + (86400 * 30), "/");
            }
        }

        $this->open = 0;
    }

    public function openCookies(){
        $this->open = 1;
    }


    public function change($identifier){
        if($identifier == 'marketing'){
            if($this->toggleMarketing == 1){
                $this->toggleMarketing = 0;
            }else{
                $this->toggleMarketing = 1;
            }
        }elseif($identifier == 'advertising'){
            if($this->toggleAdvertising == 1){
                $this->toggleAdvertising = 0;
            }else{
                $this->toggleAdvertising = 1;
            }
        }
        $this->render();
    }

    public function render(){
        return view('livewire.cookies');
    }
}
