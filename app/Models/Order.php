<?php

namespace App\Models;

use App\Models\Options\WithSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, WithSearch;

    protected $fillable = [
        'user_id',
        'payment_id',
        'delivery_id',
        'voucher_id',
        'updated_by',   //-
        'order_code',
        'delivery_order_code',  //++
        'items_count',
        'total_price',
        'discount_price',
        'tax_price',
        'sub_total',
        'grand_total',
        'order_total',
        'exchange_rate',
        'exchange_currency',
        'order_success',    //++
        'is_paid',  //++
        'transaction_number',
        'bank_tran_number', //++
        'bank_code',    //++
        'name',
        'phone',
        'delivery_fee',
        'delivery_service_id',
        'cod_amount',   //++
        'person_pay_delivery_fee',  //-
        'address',
        'api_address',
        'note',
        'required_note',    //-
        'status', //-
        'active',   //-
    ];

    protected $casts = [
        'api_address' => 'object',
        'exchange_currency' => 'object',
    ];

    protected $attributes = [
        'exchange_currency' => '{"from":"VND","to":"VND"}'
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->using(OrderDetail::class)
            ->withPivot('price', 'quantity', 'sku');
    }

    public function setOrderCodeAttribute($value)
    {
        $this->attributes['order_code'] = strtoupper($value);
    }
}
