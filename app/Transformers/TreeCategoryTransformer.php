<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Category;

class TreeCategoryTransformer extends TransformerAbstract{

    public function transform(Category $model): array{
        if ($model->childrenCategories) {
            $item = [
                'id' => $model->id,
                'name' => $model->name,
                'parent_id' => $model->parent_id,
            ];
            foreach ($model->childrenCategories as $value) {
                $item['children'][] = $this->transform($value);
            }
            return $item;
        }
        return [
            'id' => $model->id,
            'name' => $model->name,
            'parent_id' => $model->parent_id,
        ];
    }

}
