<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Http\Livewire\Message;
use App\Models\Location\District;
use App\Models\Location\Province;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditAddressComponent extends Component
{
    use WithNotifyMsgUi;

    public User         $user;
    public Collection   $provinces;
    public Collection   $districts;
    public array        $userAddress    =   [];
    protected           $rules          =   [
        'userAddress.province_id'       =>  'required|exists:App\Models\Location\Province,id',
        'userAddress.district_id'       =>  'required|exists:App\Models\Location\District,id',
        'userAddress.street'            =>  'required|string|max:256',
    ];

    public function mount(): void
    {
        $this->districts = $this->provinces = collect();
        $this->getUserAddress();
    }

    public function render()
    {
        return view('livewire.auth.edit-address-component');
    }

    public function getUserAddress(): void
    {
        $this->userAddress['province_id']   = $this->user->address?->province_id;
        $this->userAddress['district_id']   = $this->user->address?->district_id;
        $this->userAddress['street']        = $this->user->address?->street;
    }

    public function getInitAddress(): void
    {
        $this->getUserAddress();
        !$this->provinces->count() && $this->provinces = Province::all();
        $this->districts = District::whereProvinceId($this->userAddress['province_id'])->get();
    }

    public function updatedUserAddressProvinceId(int $value): void
    {
        unset($this->userAddress['district_id']);
        $this->districts = District::whereProvinceId($value)->get();
        $this->districts->isEmpty() && $this->flashMessage(Message::DATA_NOT_FOUND, 'error');
    }

    public function changeAddress(): void
    {
        $this->validate();
        $this->user->address()->updateOrCreate(['user_id' => $this->user->id], $this->userAddress);
        $this->user->refresh();
        $this->flashMessage('Your address has been updated');
        $this->dispatchBrowserEvent('address-changed');
    }
}
