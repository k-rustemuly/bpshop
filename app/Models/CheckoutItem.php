<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutItem extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        "checkout_id",
        "product_id",
        "price",
        "quantity",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
