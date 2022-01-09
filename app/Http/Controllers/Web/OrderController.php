<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Promo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang as Lang;
class OrderController extends Controller
{
    protected $viewName = 'web.';
    public function index($id)
    {
        // $user=User::find($id);
        // $cart = Cart::where('user_id', $id)->where('status', "=", 0)->first();

        $cart = Cart::find($id);

        $user = User::where('id', $cart->user_id)->first();
        $cities = City::all();
        return view($this->viewName . 'order', compact('cart', 'user', 'cities'));
    }
    public function delivery(Request $request)
    {
        $delivery = City::where('id', $request->city)->first()->delivery;
        echo $delivery;

    }
    public function promo(Request $request)
    {
        $result1 = 50;
        $result2 = 10;
        $result3 = 40;
        $cart = Cart::where('id', $request->cart_id)->first();
        $now = Carbon::now();
        $promo = Promo::where('promo_key', $request->coupon)->where('expired_date', '>', $now)->where('status', '=', 1)->first();
        $rowtotal = 0;
        $footTotal = 0;
        if ($promo) {
            $result2 = 0;
            if ($promo->category_id == null && $promo->product_id == null) {
                \Log::info("message1");
                foreach ($cart->items as $item) {
                    $rowtotal = $item->product->price_after_discount * $item->quantity;
                    $footTotal += $rowtotal;
                }
                \Log::info($footTotal);
                $result3 = $footTotal - $promo->value;
            }
            if ($promo->category_id != null && $promo->product_id == null) {
                \Log::info("message2");
                foreach ($cart->items as $item) {

                    if ($item->product->category_id == $promo->category_id) {

                        $rowtotal = ($item->product->price_after_discount * $item->quantity) - ($promo->value * $item->quantity);
                        $footTotal += $rowtotal;

                    } else {
                        $rowtotal = $item->product->price_after_discount * $item->quantity;
                        $footTotal += $rowtotal;
                    }
                    $result3 = $footTotal;
                }
            }
            if ($promo->category_id == null && $promo->product_id != null) {
                \Log::info("message3");
                foreach ($cart->items as $item) {

                    if ($item->product->id == $promo->product_id) {

                        $rowtotal = ($item->product->price_after_discount * $item->quantity) - ($promo->value * $item->quantity);
                        $footTotal += $rowtotal;

                    } else {
                        $rowtotal = $item->product->price_after_discount * $item->quantity;
                        $footTotal += $rowtotal;
                    }
                    $result3 = $footTotal;
                }
            }
            echo json_encode(array($result1, $result2, $result3));

        } else {
            $result2 = 1;
            echo json_encode(array($result1, $result2, 'invalid promo'));

        }
    }

    public function storeOrder(Request $request)
    {
        // dd($request->all());
        //save order >> order items >> update cart
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//save order
            $max = Order::orderby('id', 'desc')->first();

            $max = ($max != null) ? intval($max['order_no']) : 0;
            $max++;

            $cart = Cart::where('id', $request->cart_id)->first();
            $city=City::where('id',$request->city)->first();
            $returnData = [
                'order_no' => $max,
                'user_id' => $request->user_id,
                'address' => $request->address,
                'order_date'=>Carbon::now(),
                'copoun'=>$request->get('coupon_code'),
                'subtotally'=>$request->subtotally,
                'delivery_cost'=>$city->delivery ??'',
                'total'=>$request->total,
                'status'=>0,


            ];
            $order = Order::create($returnData);
            //save items
            foreach($cart->items as $item){
$orderItem=new Order_item();
$orderItem->order_id=$order->id;
$orderItem->cart_id=$request->cart_id;
$orderItem->product_id=$item->product_id;
$orderItem->price=$item->product->price_after_discount ?? '';
$orderItem->quantity=$item->quantity;
$orderItem->total=$item->product->price_after_discount*$item->quantity;
$orderItem->save();
            }

             //update cart
             $cart->update(['status' => 1]);
             $promo = Promo::where('promo_key', $request->coupon)->first();
             if($promo){
                $promo->update(['status' => 0]);

             }
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            \Session::flash('flash_success', Lang::get('تم اكتمال الطلب!'));
            return view($this->viewName.'confirm');
                } catch (\Throwable $e) {
            DB::rollback();
return $e->getMessage();
            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        }

    }
}
