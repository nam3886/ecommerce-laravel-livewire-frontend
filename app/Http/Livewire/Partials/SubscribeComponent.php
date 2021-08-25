<?php

namespace App\Http\Livewire\Partials;

use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Models\Subscriber;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class SubscribeComponent extends Component
{
    use WithNotifyMsgUi;

    public string $email    =   '';

    protected $rules        =   [
        'email'             =>  'required|email'
    ];

    public function render()
    {
        return view('livewire.partials.subscribe-component');
    }

    public function subscribe()
    {
        try {
            $this->validate();
        } catch (ValidationException $th) {
            return $this->flashMessage($th->validator->getMessageBag()->first(), 'error');
        }

        Subscriber::firstOrCreate(['email' => $this->email]);
        $this->flashMessage('Thanks for subscribing');
        $this->reset();
    }
}
