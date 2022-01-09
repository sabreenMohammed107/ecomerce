<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class PromoController extends Controller
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
      public function __construct(Promo $object)
      {
          $this->middleware('auth');
          // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
          // $this->middleware('permission:users-create', ['only' => ['create','store']]);
          // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
          // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
          $this->object = $object;
          $this->viewName = 'admin.promo.';
      $this->routeName = 'promo.';
      }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Promo::orderBy("created_at", "Desc")->get();


        return view($this->viewName.'index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();

        return view($this->viewName . 'create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total_wanted = 10;
for ( $i = 0; $i < $total_wanted; $i++ ) {
    $promo = new promo;
// dd($promo);
    if ($request->get('tab') == 'igotnone') {
        $promo->category_id = $request->category_id;
        // $promo->product_id=null;

    }else if($request->get('tab') == 'igottwo'){
        // $promo->category_id =null;
        $promo->product_id = $request->product_id;
    }else{
        // $promo->category_id =null;
        // $promo->product_id=null;

    }
    $promo->promo_key = uniqid("prefix");
    $promo->value = $request->get('value');
    $promo->status = 1;
    $promo->expired_date =Carbon::parse($request->get('expired_date'));

    $promo->save();
}
return redirect()->route($this->routeName . 'index')->with('flash_success','تم الحفظ بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $row = Promo::findOrFail($id);


        try {
            $row->delete();

        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger','هذا المنتج مرتبط بجدول اخر');

        }
            return redirect()->route($this->routeName.'index')->with('flash_success', ' تم الحذف بنجاح!');

    }
}
