<?php

namespace App\Observers;

use App\Models\Order;
use Spatie\ResponseCache\Facades\ResponseCache;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        if (!$order->is_paid) return;

        foreach ($order->items as $item) {
            $item->pivot->variant()->decrement('quantity', $item->pivot->quantity);
            $item->pivot->variant->product()->decrement('quantity', $item->pivot->quantity);
            cache()->forget("product_detail_{$item->pivot->variant->product->slug}");
        }

        cache()->forget('home_new_products');
        cache()->forget('home_best_products');
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
