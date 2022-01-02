<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Product_color;
use App\Models\Product_component;
use App\Models\Product_rate;
use App\Models\Product_size;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
class ProductController extends Controller
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
     public function __construct(Product $object)
     {
         $this->middleware('auth');
        //  $this->middleware('permission:products-list|products-create|products-edit|products-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:products-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:products-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:products-delete', ['only' => ['destroy']]);
         $this->object = $object;
         $this->viewName = 'admin.product.';
     $this->routeName = 'product.';
     }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows=Product::orderBy("created_at", "Desc")->get();


        return view($this->viewName.'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =Category::all();
        $attachments=[];
        $colors=[];
        $features =[];
        $rates =[];
        $sizes=[];
        $mainColors=Color::all();
        $mainSizes=Size::all();
        return view($this->viewName.'add', compact('categories','attachments','mainColors','colors','features','rates','sizes','mainSizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ar_name' => 'required',
            'en_name' => 'required',
        'price' => 'required',


    ], [

        'ar_name.required' => 'حقل الاسم مطلوب',
        'en_name.required' => 'حقل الاسم مطلوب',
        'price.required' => 'حقل السعر مطلوب',

    ]);
    try
    {
        $values = array_except($request->all(), ['_token', 'price_after_discount', 'status']);

        $values['price_after_discount'] = $values['price'] - $values['discount'];
        if ($request->input('status') == 1) {
            $values['status'] = 1;
        } else {
            $values['status'] = 0;
        }

       $product= $this->object::create($values);
        return redirect()->route($this->routeName . 'edit', $product->id)->with('flash_success','تم الحفظ بنجاح');
    } catch (\Throwable $e) {

        return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
    }
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
        $product = Product::where('id', '=', $id)->first();
        $attachments=$product->images;
        $categories =Category::all();
        $colors = Product_color::where('product_id', '=', $id)->get();
         $mainColors=Color::all();
          //features
        $features = Product_component::where('product_id', '=', $id)->get();
        //rates
        $rates=Product_rate::where('product_id',$id)->get();
        //
        $sizes=Product_size::where('product_id', '=', $id)->get();
        $mainSizes=Size::all();
        return view($this->viewName . 'edit', compact('product', 'attachments','categories','colors','mainColors','features','rates','sizes','mainSizes'));
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
        $this->validate($request, [
            'ar_name' => 'required',
            'en_name' => 'required',
        'price' => 'required',


    ], [

        'ar_name.required' => 'حقل الاسم مطلوب',
        'en_name.required' => 'حقل الاسم مطلوب',
        'price.required' => 'حقل السعر مطلوب',

    ]);
    try
    {
        $values = array_except($request->all(), ['_token', 'price_after_discount', 'status']);

        $values['price_after_discount'] = $values['price'] - $values['discount'];
        if ($request->input('status') == 1) {
            $values['status'] = 1;
        } else {
            $values['status'] = 0;
        }

        $this->object::findOrFail($id)->update($values);
        return redirect()->route($this->routeName . 'edit', $id)->with('flash_success','تم الحفظ بنجاح');
    } catch (\Throwable $e) {

        return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Product::where('id', '=', $id)->first();

        try{
            $row->delete();


            }
            catch(QueryException $q){

                return redirect()->back()->with('flash_danger','هذا المنتج مرتبط بجدول اخر');

            }
                return redirect()->route($this->routeName.'index')->with('flash_success', ' تم الحذف بنجاح!');

    }
}
