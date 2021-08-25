<?php

namespace App\Models;

use App\Models\Options\WithStandardPrice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory, WithStandardPrice;

    protected $table = 'vouchers';

    protected $fillable = [
        'price',
        'stock',
        'unit',
        'products_id',  //if = all => apply for all products
        'code',
        'description',
        'start',
        'end',
        'valid',
        'updated_by',
        'active',
    ];

    protected $casts = [
        'products_id' => 'array',
    ];

    public function getStartAttribute($value): Carbon
    {
        return Carbon::create($value);
    }

    public function getEndAttribute($value): Carbon
    {
        return Carbon::create($value);
    }
}
