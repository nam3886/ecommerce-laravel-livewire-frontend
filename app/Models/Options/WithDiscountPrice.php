<?php

namespace App\Models\Options;

use App\Helpers\Currency;

trait WithDiscountPrice
{
    public function getPriceAfterDiscountAttribute(): int
    {
        // khi nhập data đã set ceilThousand
        // => không discount => ko cần làm tròn
        // => có discount => cần làm tròn
        $discount = $this->discount;
        if (empty($discount)) return $this->price;
        $price = match ($discount->unit) {
            'percent'   =>  $this->price * (100 - $discount->price) / 100,
            'currency'  =>  $this->price - $discount->price,
        };
        return Currency::ceilThousand($price);
    }
}
