<?php

namespace App\Http\Controllers\Api;

use App\Models\Checkout;
use App\Transformers\OrderTransformer;

class OrderController extends BaseController
{

    public function list(){
        $user = auth()->user();
        $orders = Checkout::whereUserId($user->id)->get()->all();

        if(empty($orders)) $this->error("Заказы не найдены");

        $ordersTree = fractal()->collection($orders, new OrderTransformer())->toArray();

        return $this->success($ordersTree["data"]);
    }
}
