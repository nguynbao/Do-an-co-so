<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'category_id',
        'brand_id',
        'product_price',
        'unit_price',
        'product_color',
        'product_size',
        'product_image',
        'product_content',
        'product_status',
        'product_desc'
    ];

    /**
     * Get the category that owns the product
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    /**
     * Get the brand that owns the product
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    /**
     * Get the order details for this product
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'product_id');
    }

    /**
     * Get the orders that include this product
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'product_id', 'order_id')
            ->withPivot('quantity', 'unit_price', 'subtotal');
    }

    /**
     * Scope for active products
     */
    public function scopeActive($query)
    {
        return $query->where('product_status', 0);
    }

    /**
     * Get product image url
     */
    public function getImageUrlAttribute()
    {
        return asset('uploads/products/' . $this->product_image);
    }
}
