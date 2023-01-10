<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'products',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($cart) {
            /**
             * @deprecated
             */
            if($user = auth('sanctum')->user()) {
                $cart->user_id = $user->id;
            }
            else if(!$cart->uuid){
                $cart->uuid = Str::uuid();
            }
            $cart->save();
        });
    }

    public static function calcTotal($id = 0){
        $total = 0;
        $cartItems = CartItem::whereCartId($id)->get()->all();
        $quantityItems = count($cartItems);
        foreach($cartItems as $item){
            $total+= $item["price"]*$item["quantity"];
        }
        self::whereId($id)->update(["total" => $total, "quantity" => $quantityItems]);
    }
}
