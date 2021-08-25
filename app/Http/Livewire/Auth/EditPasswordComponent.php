<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditPasswordComponent extends Component
{
    use WithNotifyMsgUi;

    public User $user;
    public array $edit = [];

    protected $rules            =   [
        'edit.password'         =>  'required',
        'edit.new_password'     =>  'required|min:8|max:255|confirmed',
    ];

    public function render()
    {
        return view('livewire.auth.edit-password-component');
    }

    public function changePassword()
    {
        $this->validate();

        if (!Auth::guard('web')->validate([
            'email' => $this->user->email,
            'password' => $this->edit['password'],
        ])) {
            throw ValidationException::withMessages([
                'edit.password' => __('auth.password'),
            ]);
        }

        $this->user->password = $this->edit['new_password'];
        $this->user->save();
        session()->flash('message', 'Your password has been updated');
        Auth::logout();
        return redirect()->route('login');
    }
}
