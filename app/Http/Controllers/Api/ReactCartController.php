<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Cart_item;

use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_color;
use App\Models\Product_rate;
use App\Models\Product_size;
use App\Models\Promo;
use App\Models\Size;
use App\Models\Suggestion;
use App\Models\User;
use App\Notifications\MyFirstNotification;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;
use Validator;

class ReactCartController extends BaseController
{

    //cart where status =0
    public function cart()
    {

        try
        {

            $user = Auth::user();
            $cartData = Cart::where('user_id', $user->id)->where('status', "=", 0)->get();
            if ($cartData) {

                return $this->sendResponse(CartResource::collection($cartData), 'Geting Cart successfully.');
            } else {
                return $this->sendError('Invalid Cart !');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 'Error happens!!');
        }
    }
    public function storeCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'color' => 'required',
            'size' => 'required',

        ]);
//exist product
        $exist = Cart::where('product_id', $request->product_id)->first();
        if ($exist) {
            return $this->sendError('this product already in your cart !');
        }
        if ($validator->fails()) {
            return $this->convertErrorsToString($validator->messages());
        }

        try
        {
            $user = Auth::user();
            $color = Color::where('colorid', $request->color)->first();
            $size = Size::where('name', $request->size)->first();
            if ($color) {
                $product_color = Product_color::where([
                    ['product_id', '=', $request->product_id],
                    ['color_id', '=', $color->id],

                ])->first();
            }
            if ($size) {
                $product_size = Product_size::where([
                    ['product_id', '=', $request->product_id],
                    ['size_id', '=', $size->id],

                ])->first();
            }

            if ($user) {
                $data = [
                    'user_id' => $user->id,
                    'product_size' => $product_size->id ?? null,
                    'product_color' => $product_color->id ?? null,
                    'product_id' => $request->product_id,
                    'quantity' => 1,

                    'status' => 0,
                ];

                $cart = Cart::create($data);

                return $this->sendResponse($cart, 'Product Add To Card');
            } else {
                return $this->sendError('You must login before !');
            }

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 'Error happens!!');
        }
    }

    public function AddQuantity($id)
    {
        $row = Cart::where('id', $id)->first();
        $row->update(['quantity' => $row->quantity + 1]);
        return $this->sendResponse($row, ' Cart updated successfully.');
    }

    public function SubstractQuantity($id)
    {

        $row = Cart::where('id', $id)->first();
        $row->update(['quantity' => $row->quantity - 1]);
        return $this->sendResponse($row, ' Cart updated successfully.');
    }
    public function deleteProduct($id)
    {
        $row = Cart::where('product_id', $id)->first();
        $cartItems = Cart_item::where('cart_id', $id)->get();
        try {
            if ($cartItems) {
                foreach ($cartItems as $item) {
                    $item->delete();
                }
            }

            $row->delete();

        } catch (QueryException $q) {

            return $this->sendError($q->getMessage(), 'You cannot delete related with another...');

        }
        return $this->sendResponse(null, 'Data Has Been Deleted Successfully !.');

    }
}
