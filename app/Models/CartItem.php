<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "cart_id",
        "product_id",
        "price",
        "quantity",
    ];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($cartItem) {
            Cart::calcTotal($cartItem->cart_id);
        });
        static::deleted(function ($cartItem) {
            Cart::calcTotal($cartItem->cart_id);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
