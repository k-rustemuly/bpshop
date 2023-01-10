<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager;

class OrderTransformer extends TransformerAbstract
{

    public function transform(Checkout $model): array{
        return [
            "id"      => $model->id,
            "total"   => $model->total,
            "quantity"   => $model->quantity,
            "created_at"   => $model->created_at->format('Y-m-d H:i:s'),
            "items"  => fractal()->collection(CheckoutItem::whereCheckoutId($model->id)->get()->all(), new OrderItemTransformer())->toArray()["data"]
        ];
    }

}
