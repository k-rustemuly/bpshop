<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\CartAddRequest;
use App\Http\Requests\Api\CartDeleteRequest;
use App\Http\Requests\Api\GuestCheckoutRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use Illuminate\Support\Str;
use App\Transformers\CartItemTransformer;

class CartController extends BaseController
{

    public function store(CartAddRequest $request){
        $data = $request->validated();
        $product_id = $data["product_id"];
        $quantity = $data["quantity"];

        $params = [];
        if($user = auth("sanctum")->user()) {
            $params["user_id"] = $user->id;
        }
        else {
            $params["uuid"] = $request->uuid??Str::uuid();
        }
        $cart = Cart::firstOrCreate($params);

        $product = Product::find($product_id);

        CartItem::updateOrCreate([
            "cart_id" => $cart->id,
            "product_id" => $product->id,
        ], [
            "price" => $product->price,
            "quantity" => $quantity
        ]);
        $cart = $cart->fresh();
        return $this->success($cart);
    }

    public function delete(CartDeleteRequest $request){
        $data = $request->validated();
        $product_id = $data["product_id"];

        $params = [];
        if($user = auth("sanctum")->user()) {
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

    public function index(Request $request){
        $params = [];
        if($user = auth("sanctum")->user()) {
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

        $cartItems = CartItem::where("cart_id", $cart->id)->get()->all();
        $transformed = fractal()->collection($cartItems, new CartItemTransformer())->toArray();
        return $this->success($transformed["data"]);
    }

    public function checkout(){
        $user = auth()->user();
        $cart = Cart::whereUserId($user->id)->first();

        if(!$cart) return $this->error("Корзина не найдено");

        $cartItem = CartItem::where("cart_id", $cart->id);

        $cartItems = $cartItem->get()->all();

        if(empty($cartItems)) return $this->error("Корзина пуста");

        $checkOut = Checkout::create(
            [
                "user_id" => $user->id,
                "email" => $user->email,
                "phone_number" => $user->phone_number,
                "quantity" => $cart->quantity,
                "total" => $cart->total
            ]
        );

        foreach($cartItems as $item){
            $checkoutItem = [
                "quantity" => $item->quantity,
                "price" => $item->price,
                "product_id" => $item->product_id,
                "checkout_id" => $checkOut->id
            ];
            CheckoutItem::create($checkoutItem);
        }

        $cartItem->delete();
        $cart->delete();
        return $this->success("Заказ успешно оформлен");
    }

    public function checkoutGuest(GuestCheckoutRequest $request){
        $contacts = $request->validated();
        $params["uuid"] = $request->uuid;
        $cart = Cart::where($params)->first();

        if(!$cart) return $this->error("Корзина не найдено");

        $cartItem = CartItem::where("cart_id", $cart->id);

        $cartItems = $cartItem->get()->all();

        if(empty($cartItems)) return $this->error("Корзина пуста");

        $checkOut = Checkout::create([
            "email" => $contacts["email"],
            "phone_number" => $contacts["phone_number"],
            "quantity" => $cart->quantity,
            "total" => $cart->total
        ]);

        foreach($cartItems as $item){
            $checkoutItem = [
                "quantity" => $item->quantity,
                "price" => $item->price,
                "product_id" => $item->product_id,
                "checkout_id" => $checkOut->id
            ];
            CheckoutItem::create($checkoutItem);
        }

        $cartItem->delete();
        $cart->delete();
        return $this->success("Заказ успешно оформлен");
    }

}
