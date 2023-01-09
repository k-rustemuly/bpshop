<?php
namespace App\Repositories;

use App\Models\Category as Model;

class CategoryRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(){
        return $this->model::where('parent_id', 0)
                        ->with('childrenCategories')
                        ->get()
                        ->all();
    }

}
