<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'order_date',
        'order_status',
        'total_amount',
        'shipping_address',
        'payment_method',
        'payment_status',
    ];

    /**
     * Order status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Payment method constants
     */
    const PAYMENT_CREDIT_CARD = 'credit_card';
    const PAYMENT_CASH_ON_DELIVERY = 'cash_on_delivery';
    const PAYMENT_BANK_TRANSFER = 'bank_transfer';

    /**
     * Payment status constants
     */
    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_FAILED = 'failed';

    /**
     * Get the user that owns the order
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the order details for this order
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    /**
     * Get the products in this order
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id', 'product_id')
            ->withPivot('quantity', 'unit_price', 'subtotal');
    }
}
