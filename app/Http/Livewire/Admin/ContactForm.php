<?php

namespace App\Http\Livewire\Admin;

use App\Mail\ContactMail;
use Illuminate\Mail\Mailables\Address;
use Livewire\Component;
use Mail;

class ContactForm extends Component
{
    // public properties
    public $name;
    public $email;
    public $message;
    public $can_submit = false;

    // validation rules
    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    // real-time validation
    public function updated($propertyName, $propertyValue)
    {
        $this->can_submit = false;
        $this->validateOnly($propertyName);
        if ($this->name && $this->email && $this->message)
            $this->can_submit = true;
    }

    // send email
    public function sendEmail()
    {
        // validate the whole request before sending the email
        $validatedData = $this->validate();

        // send email
        $template = new ContactMail([
            'fromName' => 'KMAD - Info',
            'fromEmail' => 'info@kmad.com',
            'subject' => 'KMAD - Contact Form',
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);
        $to = new Address($this->email, $this->name);
        Mail::to($to)
            ->send($template);

        // show a success toast
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "<p class='font-bold mb-2'>Beste $this->name,</p>
                       <p>Bedankt for uw bericht.<br>Wij contacteren u zo snel mogelijk.</p>",
        ]);

        // reset all public properties
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.contact-form');
    }
}
