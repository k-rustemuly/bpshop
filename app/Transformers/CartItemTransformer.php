<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\CartItem;
use App\Http\Resources\ProductResource;

class CartItemTransformer extends TransformerAbstract
{

    public function transform(CartItem $model): array{
        return [
            "id"      => $model->id,
            "quantity"   => $model->quantity,
            "product"  => new ProductResource($model->product)
        ];
    }

}
