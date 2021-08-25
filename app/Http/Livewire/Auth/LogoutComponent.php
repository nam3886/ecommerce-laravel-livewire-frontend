<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutComponent extends Component
{
    public string $class = '';

    public function render()
    {
        return view('livewire.auth.logout-component');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
