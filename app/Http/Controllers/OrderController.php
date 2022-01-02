<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $object;
    protected $viewName;
    protected $routeName ;
    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Order $object)
    {
        $this->middleware('auth');
       //  $this->middleware('permission:products-list|products-create|products-edit|products-delete', ['only' => ['index', 'show']]);
       //  $this->middleware('permission:products-create', ['only' => ['create', 'store']]);
       //  $this->middleware('permission:products-edit', ['only' => ['edit', 'update']]);
       //  $this->middleware('permission:products-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.order.';
        $this->routeName = 'admin-order.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows=Order::orderBy("created_at", "Desc")->get();


        return view($this->viewName.'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Order::where('id', '=', $id)->first();
         $items=[];
        // $cart=Cart::where('id',$row->cart_id)->first();
        if($row){
            $items=$row->items;
        }

        return view($this->viewName . 'edit', compact('row', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'delivery_cost' => $request->delivery_cost,
            'total' => $request->total,
            'status' => $request->status,

        ];
        $this->object::findOrFail($id)->update($data);
        return redirect()->route($this->routeName.'index')->with('flash_success','تم الحفظ بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
