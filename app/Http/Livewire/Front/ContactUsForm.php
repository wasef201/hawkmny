<?php

namespace App\Http\Livewire\Front;

//use App\Http\Livewire\BaseComponent;
use App\Http\Livewire\BaseComponent;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactUsForm extends BaseComponent
{
    public string $name='';
    public string $email='';
    public string $phone='';
    public string $message='';
    public string $subject='';

    public function render()
    {
        return view('livewire.front.contact-us-form');
    }

    protected $rules = [
        'name' => 'required',
        'subject' => 'required',
        'email' => 'required|email:rfc,dns',
        'phone' => 'required',
        'message'=>'required|min:10'
    ];

    public function submit(){
        $this->validate();
//        ContactMessage::create([
//            'name'=>$this->name,
//            'email'=>$this->email,
//            'phone'=>$this->phone,
//            'message'=>$this->message,
//        ]);
        $contact = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];
        Mail::to(general_setting()->site_email)->send(new ContactFormMail($contact));

        $this->reset();
        $this->resetValidation();

        $this->successMessage(__('messages.sent successfully'));
    }
}
