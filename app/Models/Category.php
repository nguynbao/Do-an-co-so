<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category_product';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'category_desc',
        'category_status'
    ];

    /**
     * Get the products associated with this category
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('category_status', 0);
    }
}
