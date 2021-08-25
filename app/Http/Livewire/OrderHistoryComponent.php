<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Services\GHN\GHNOrderService;
use App\Services\GHN\GHNStatusService;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;

class OrderHistoryComponent extends Component
{
    public Order $order;

    public function mount($orderNumber)
    {
        $this->order = Order::with('payment', 'items', 'items.pivot.variant')
            ->whereOrderCode($orderNumber)
            ->whereOrderSuccess(1)
            ->whereUserId(auth()->id())
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.order-history-component');
    }

    public function getOrderStatus(): void
    {
        $status = (new GHNOrderService())->getOrderDetail($this->order->delivery_order_code)
            ->get('status');
        $this->order->status = GHNStatusService::getMessage($status);
        $this->order->save();
    }

    public function exportPDF()
    {
        $pdfContent = PDF::loadView('exports.invoice', [
            'order' => $this->order,
        ])->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            "invoice-{$this->order->order_code}.pdf"
        );
    }
}
