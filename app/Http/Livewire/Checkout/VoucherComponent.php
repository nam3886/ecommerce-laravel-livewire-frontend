<?php

namespace App\Http\Livewire\Checkout;

use App\Http\Livewire\Options\WithCartSession;
use App\Http\Livewire\Message;
use App\Models\Voucher;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class VoucherComponent extends Component
{
    use WithCartSession;

    public string $voucher;
    public bool $isValid = false;
    public ?string $voucherDescription;
    public array $class = [];

    protected $rules = ['voucher' => 'required|string|exists:App\Models\Voucher,code'];

    public function mount()
    {
        $this->voucher = session($this->voucherSessionKey) ?? '';

        if (empty($this->voucher)) return;

        $this->isValid              =   true;
        $this->voucherDescription   =   Voucher::whereCode($this->voucher)->first()?->description;
    }

    public function render()
    {
        return view('livewire.checkout.voucher-component');
    }

    public function addVoucher()
    {
        try {
            $this->validate();
        } catch (ValidationException $th) {
            $message = collect($th->errors()['voucher'])->first();
            $this->addError('voucher', $message);
            return $this->flashErrorMessage($message);
        }

        $voucher = Voucher::whereCode($this->voucher)
            ->whereValid(1)
            ->whereActive(1)
            ->where('stock', '>', 1)
            ->first();

        if (!$voucher) return $this->flashErrorMessage(Message::VOUCHER_NOT_AVAILABLE);

        $this->handleAddVoucher($voucher, function () use ($voucher) {
            $this->voucherDescription   =   $voucher->description;
            $this->isValid              =   true;
        });
    }

    public function removeVoucher()
    {
        if (empty($this->voucher)) return;

        $this->isValid              =   false;
        $this->voucher              =   '';
        $this->voucherDescription   =   '';

        $this->handleRemoveVoucher();
    }
}
