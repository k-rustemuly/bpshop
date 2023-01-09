<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends BaseController
{

    public function slug(Request $request)
    {
        $product = Product::whereSlug($request->slug)->first();
        if(!$product) return $this->notFound();

        return $this->success(new ProductResource($product));
    }

}
