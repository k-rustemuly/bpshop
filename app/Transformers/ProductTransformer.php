<?php

namespace App\Transformers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use League\Fractal\TransformerAbstract;


class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $model): array{
        $resource = new ProductResource($model);
        return json_decode($resource->toJson(), true);
    }
}
