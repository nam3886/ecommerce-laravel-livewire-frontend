<?php

namespace App\Models\Options;

use App\Helpers\Currency;

trait WithStandardPrice
{
    public function setPriceAttribute($value)
    {
        // từ 1000 trở lên
        $this->attributes['price'] = strlen($value) > 3
            ? Currency::ceilThousand($value)
            : $value;
    }
}
