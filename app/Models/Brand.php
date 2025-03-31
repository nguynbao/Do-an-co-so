<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand_product';
    protected $primaryKey = 'brand_id';

    protected $fillable = [
        'brand_name',
        'brand_desc',
        'brand_status'
    ];

    /**
     * Get the products associated with this brand
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }

    /**
     * Scope for active brands
     */
    public function scopeActive($query)
    {
        return $query->where('brand_status', 0);
    }
}
