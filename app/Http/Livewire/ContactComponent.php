<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Mail\UserContact;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactComponent extends Component
{
    use WithNotifyMsgUi;

    public array $user = [];

    protected $rules = [
        'user.name' => 'required|min:3|max:255',
        'user.email' => 'required|email',
        'user.subject' => 'required|min:3|max:255',
        'user.message' => 'required|min:3|max:1024',
    ];

    public function mount()
    {
        if (auth()->check()) {
            $this->user = auth()->user()->only('name', 'email');
        }
    }

    public function render()
    {
        return view('livewire.contact-component');
    }

    public function mail()
    {
        $this->validate();

        $appEmailAddress = config('settings.default_email_address');

        Mail::to($appEmailAddress)->send(new UserContact($this->user));

        $this->flashMessage('Mail successfully!!!');
    }
}
