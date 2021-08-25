<?php

namespace App\Models;

use App\Models\Options\WithImages;
use App\Models\Options\WithSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, WithImages, WithSearch;

    protected $fillable = [
        'name',
        'slug',
        'link',
        'image',
        'description',
        'content',
        'order',
        'updated_by',
        'active',
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
