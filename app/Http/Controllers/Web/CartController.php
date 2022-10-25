<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Favorites_product;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang as Lang;

class CartController extends Controller
{
    protected $viewName = 'web.';
    public function index($id)
    {
        $user = User::find($id);
        $cart = Cart::where('user_id', $id)->where('status', "=", 0)->first();

        return view($this->viewName . 'cart', compact('user', 'cart'));
    }
public function fav($id){

    $user = User::find($id);
    $favs = Favorites_product::where('client_id', $id)->get();

    return view($this->viewName . 'fav', compact('user', 'favs'));
}
    public function storeCart(Request $request)
    {

        //exist product
        $exist = Cart_item::where('product_id', $request->product_id)
            ->whereHas('cart', function ($query) use ($request) {
                $query->where('status', "=", 0);
            })
            ->first();
        if ($exist) {
            \Session::flash('flash_success', Lang::get('هذا المنتج موجود بالفعل'));
            return view($this->viewName . 'cart');

        }

        // DB::beginTransaction();
        // try
        // {

        //     // Disable foreign key checks!
        //     DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $user = User::find($request->user_id);
            $cart = Cart::where('user_id', $request->user_id)->where('status', "=", 0)->first();
            $product = Product::where('id', $request->product_id)->first();

            //items
            if ($cart) {
                $ItemsArray = [];
                // foreach ($cartData as $cart) {

                $data = [
                    'cart_id' => $cart->id,
                    'product_id' => $request->product_id,
                    'price' => $request->quantity * $product->price,
                    'quantity' => $request->quantity,
                    'product_size' => $request->product_size ?? null,
                    'product_color' => $request->product_color ?? null,

                ];

                $cartItem = Cart_item::create($data);
                array_push($ItemsArray, $cart->product);
            } else {
                $data2 = [
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                    'price' => $request->quantity * $product->price,
                    'quantity' => $request->quantity,
                    'product_size' => $request->product_size ?? null,
                    'product_color' => $request->product_color ?? null,
                    'status' => 0,
                ];

                $cartData = Cart::create($data2);

                //items
                if ($cartData) {
                    $ItemsArray = [];
                    // foreach ($cartData as $cart) {

                    $data = [
                        'cart_id' => $cartData->id,
                        'product_id' => $request->product_id,
                        'price' => $request->quantity * $product->price,
                        'quantity' => $request->quantity,
                        'product_size' => $request->product_size ?? null,
                        'product_color' => $request->product_color ?? null,

                    ];

                    $cartItem = Cart_item::create($data);
                    array_push($ItemsArray, $cartData->product);
                }
            }

            //update cart
            // $cartData->update(['status' => 1]);
            // }

            $returnData = [
                'user' => $user,
                'items' => $ItemsArray,
            ];

        //     DB::commit();
        //     // Enable foreign key checks!
        //     DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //     return redirect()->back();

        // } catch (\Exception$e) {
        //     DB::rollback();
        //     return redirect()->back()->with($e->getMessage());
        // }
    }
    public function storeFav(Request $request)
    {

        Favorites_product::create([
            'client_id' => $request->get('client_id'),
            'product_id' => $request->get('fav_id'),

        ]);
        return redirect()->back();

    }
    public function AddQuantity(Request $request)
    {
        \Log::info($request->all());
        $cartItem = Cart_item::where('id', $request->get('cart'))->first();
        $cart = Cart::where('id', $cartItem->cart_id)->first();
        $cartItem->update(['quantity' => $cartItem->quantity + 1]);

        return view($this->viewName . 'cartTable', compact('cart'))->render();
    }

    public function SubQuantity(Request $request)
    {
        \Log::info($request->all());
        $cartItem = Cart_item::where('id', $request->get('cart'))->first();
        $cart = Cart::where('id', $cartItem->cart_id)->first();
        $cartItem->update(['quantity' => $cartItem->quantity - 1]);

        return view($this->viewName . 'cartTable', compact('cart'))->render();
    }
    public function DelItem(Request $request)
    {
        $cartItem = Cart_item::where('id', $request->get('cart'))->first();
        $cart = Cart::where('id', $cartItem->cart_id)->first();
        $cartItem->delete();

        return view($this->viewName . 'cartTable', compact('cart'))->render();
    }

    public function DelItemFav(Request $request)
    {
        $fav = Favorites_product::where('id', $request->get('fav'))->first();


        $fav->delete();
        $favs = Favorites_product::where('client_id', $request->get('user'))->get();
        return view($this->viewName . 'favTable', compact('favs'))->render();
    }

}
