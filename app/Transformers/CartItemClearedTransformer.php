<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\CartItem;

class CartItemClearedTransformer extends TransformerAbstract
{

    public function transform(CartItem $model): array{
        return [
            "id"      => $model->id,
            "quantity"   => $model->quantity,
            "price"   => $model->price,
            "product_id"  => $model->product_id
        ];
    }

}
