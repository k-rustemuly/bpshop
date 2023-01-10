<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\CheckoutItem;
use App\Http\Resources\ProductResource;

class OrderItemTransformer extends TransformerAbstract
{

    public function transform(CheckoutItem $model): array{
        return [
            "id"      => $model->id,
            "price"   => $model->price,
            "quantity"   => $model->quantity,
            "product"  => new ProductResource($model->product)
        ];
    }

}
