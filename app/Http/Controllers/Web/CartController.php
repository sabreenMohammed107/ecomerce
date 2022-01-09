<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Lang as Lang;

class CartController extends Controller
{
    protected $viewName = 'web.';
    public function index($id)
    {
        $user=User::find($id);
        $cart = Cart::where('user_id', $id)->where('status', "=", 0)->first();


        return view($this->viewName . 'cart', compact('user','cart'));
    }

    public function storeCart(Request $request)
    {

            //exist product
        $exist = Cart_item::where('product_id', $request->product_id)
        ->whereHas('cart', function ($query) use ($request){
            $query->where('status', "=", 0);
        })
        ->first();
        if ($exist) {
            \Session::flash('flash_success', Lang::get('هذا المنتج موجود بالفعل'));
            return view($this->viewName . 'cart');

        }

        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $user = User::find( $request->user_id);
            $cart = Cart::where('user_id', $request->user_id)->where('status', "=", 0)->first();
            $product=Product::where('id',$request->product_id)->first();

if($cart){


    //items
    if ($cart) {
        $ItemsArray = [];
        // foreach ($cartData as $cart) {

            $data = [
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'price' => $request->quantity * $product->price,
                'quantity' => $request->quantity,
                'product_size' =>  $request->product_size ?? null,
        'product_color' =>  $request->product_color ?? null,

            ];

            $cartItem = Cart_item::create($data);
            array_push($ItemsArray, $cart->product);
}else{
    $data = [
        'user_id' => $user->id,



        'status' => 0,
    ];

    $cartData = Cart::create($data);

    //items
    if ($cartData) {
        $ItemsArray = [];
        // foreach ($cartData as $cart) {

            $data = [
                'cart_id' => $cartData->id,
                'product_id' => $request->product_id,
                'price' => $request->quantity * $product->price,
                'quantity' => $request->quantity,
                'product_size' =>  $request->product_size ?? null,
               'product_color' =>  $request->product_color ?? null,

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

                }
                DB::commit();
                // Enable foreign key checks!
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                return redirect()->back();


        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with($e->getMessage());
        }
    }


    public function AddQuantity(Request $request){
        $cartItem = Cart_item::where('id', $request->get('cart'))->first();
        $cart=Cart::where('id',$cartItem->cart_id)->first();
        $cartItem->update(['quantity' => $cartItem->quantity + 1]);

        return view($this->viewName.'cartTable', compact('cart'))->render();
    }


    public function SubQuantity(Request $request){
        $cartItem = Cart_item::where('id', $request->get('cart'))->first();
        $cart=Cart::where('id',$cartItem->cart_id)->first();
        $cartItem->update(['quantity' => $cartItem->quantity - 1]);

        return view($this->viewName.'cartTable', compact('cart'))->render();
    }
    public function DelItem(Request $request){
        $cartItem = Cart_item::where('id', $request->get('cart'))->first();
        $cart=Cart::where('id',$cartItem->cart_id)->first();
        $cartItem->delete();

        return view($this->viewName.'cartTable', compact('cart'))->render();
    }
}
