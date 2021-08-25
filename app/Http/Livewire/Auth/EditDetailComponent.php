<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Models\User;
use Livewire\Component;

class EditDetailComponent extends Component
{
    use WithNotifyMsgUi;

    public $birthday;
    public User $user;
    public array $genders = [
        'male'      => 'Mr.',
        'female'    => 'Mrs.',
        'other'     => 'Other.',
    ];

    protected $rules            =   [
        'user.name'             =>  'required|string|min:3|max:255',
        'user.phone'            =>  'required|regex:/(0[1-9])[0-9]{8}$/|unique:App\Models\User,phone',
        'user.gender'           =>  'required|in:male,female,other',
        'user.subscribed'       =>  'nullable|boolean',
        'user.received_offer'   =>  'nullable|boolean',
        'birthday'              =>  'required|date|before:today',
    ];

    public function mount(): void
    {
        $this->birthday = $this->user->birthday?->toDateString();
    }

    public function render()
    {
        return view('livewire.auth.edit-detail-component');
    }

    public function changeAccountDetail(): void
    {
        // without itself
        $this->rules['user.phone'] .= ",{$this->user->id}";
        $this->validate();
        $this->user->birthday = $this->birthday;
        $this->user->save();
        $this->flashMessage('Your information has been updated');
    }
}
