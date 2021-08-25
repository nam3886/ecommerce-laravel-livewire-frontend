<?php

namespace App\Models;

use App\Models\Options\WithSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory, WithSearch;

    protected $fillable = [
        'code',
        'name',
        'frontend_type',
        'is_filterable',
        'is_required',
        'active',
        'updated_by',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }
}
