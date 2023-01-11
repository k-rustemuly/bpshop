<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ProductCharacteristicValue;

class CharacteristicTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProductCharacteristicValue $model): array{
        return [
            "name"   => $model->characteristic->name,
            "value"   => $model->value,
        ];
    }
}
