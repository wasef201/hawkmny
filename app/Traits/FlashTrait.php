<?php
namespace App\Traits;

trait FlashTrait{


    public function message($message, $status){
        $this->emit('alert', ['type' => $status, 'message' => $message]);
    }

    public function successMessage(string $message):void
    {
        $this->message($message, 'success');
    }

    public function errorMessage(string $message) :void
    {
        $this->message($message, 'error');
    }

    public function infoMessage(string $message):void
    {
        $this->message($message, 'info');
    }
}
