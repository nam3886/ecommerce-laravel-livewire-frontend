<?php

namespace App\Models;

use App\Models\Options\WithStandardPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDiscount extends Model
{
    use HasFactory, WithStandardPrice;

    protected $fillable = [
        'variant_id',
        'product_id',
        'price',
        'start',
        'end',
        'unit',
        'valid',
    ];

    protected $casts    =   [
        'start'         =>  'datetime',
        'end'           =>  'datetime',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getDiscountFormatAttribute(): string
    {
        return match ($this->unit) {
            'percent'   =>  $this->price . '%',
            'currency'  =>  '$' . number_format($this->price),
        };
    }
}
