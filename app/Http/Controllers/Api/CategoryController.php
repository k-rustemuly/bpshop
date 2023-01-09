<?php

namespace App\Http\Controllers\Api;

use App\Http\Responders\JsonResponder as Responder;
use App\Repositories\CategoryRepository;
use App\Transformers\TreeCategoryTransformer;

class CategoryController extends BaseController
{
    protected $responder;

    private $categoryRepository;

    public function __construct(Responder $responder, CategoryRepository $categoryRepository)
    {
        $this->responder = $responder;
        $this->categoryRepository = $categoryRepository;
    }

    public function list()
    {
        $categories = $this->categoryRepository->getAll();
        $transformed = fractal()->collection($categories, new TreeCategoryTransformer())->toArray();
        return $this->success($transformed["data"]);
    }
}
