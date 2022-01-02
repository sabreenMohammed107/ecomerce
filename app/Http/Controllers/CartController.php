<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
     // This is for General Class Variables.
   protected $object;
   protected $viewName;
   protected $routeName ;
   /**
    * UserController Constructor.
    *
    * @return \Illuminate\Http\Response
    */
   public function __construct(Cart $object)
   {
       $this->middleware('auth');
      //  $this->middleware('permission:products-list|products-create|products-edit|products-delete', ['only' => ['index', 'show']]);
      //  $this->middleware('permission:products-create', ['only' => ['create', 'store']]);
      //  $this->middleware('permission:products-edit', ['only' => ['edit', 'update']]);
      //  $this->middleware('permission:products-delete', ['only' => ['destroy']]);
       $this->object = $object;
       $this->viewName = 'admin.cart.';
       $this->routeName = 'admin-cart.';
   }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows=Cart::orderBy("created_at", "Desc")->get();


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
        $row = Cart::where('id', '=', $id)->first();
        $items=$row->items;

        return view($this->viewName . 'show', compact('row', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
