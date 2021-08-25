<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class MyAccountComponent extends Component
{
    public Collection $myOrders;
    public User $user;

    public function mount(): void
    {
        $this->user         =   auth()->user();
        $this->myOrders     =   Order::withCount('items')
            ->whereOrderSuccess(1)
            ->whereUserId(auth()->id())
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.my-account-component');
    }
}
