<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\CartAddRequest;
use App\Http\Requests\Api\CartDeleteRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Str;

class CartController extends BaseController
{

    public function save(CartAddRequest $request){
        $data = $request->validated();
        $product_id = $data["product_id"];
        $quantity = $data["quantity"];

        $params = [];
        if($user = auth('sanctum')->user()) {
            $params["user_id"] = $user->id;
        }
        else {
            $params["uuid"] = $request->uuid??Str::uuid();
        }
        $cart = Cart::firstOrCreate($params);

        $product = Product::find($product_id);

        CartItem::updateOrCreate([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
        ], [
            'price' => $product->price,
            'quantity' => $quantity
        ]);
        $cart = $cart->fresh();
        return $this->success($cart);
    }

    public function delete(CartDeleteRequest $request){
        $data = $request->validated();
        $product_id = $data["product_id"];

        $params = [];
        if($user = auth('sanctum')->user()) {
            $params["user_id"] = $user->id;
        }
        else if($request->uuid) {
            $params["uuid"] = $request->uuid;
        }
        else {
            return $this->error("Корзина не найдено");
        }
        $cart = Cart::where($params)->first();

        if(!$cart) return $this->error("Корзина не найдено");

        $cartItem = CartItem::where("cart_id", $cart->id)
                            ->where("product_id", $product_id)
                            ->first();

        if(!$cartItem) return $this->error("Товар не найдено");

        $cartItem->delete();

        $cart = $cart->fresh();
        return $this->success($cart);
    }
}
