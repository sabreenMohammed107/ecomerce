<?php

namespace App\Http\Controllers;

use App\Models\Product_rate;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
class ProductRateController extends Controller
{
    // This is for General Class Variables.
    protected $object;
    protected $viewName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Product_rate $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:products-list|products-create|products-edit|products-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:products-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:products-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:products-delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.product.';
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'product_id' => 'required',

        ], [

            'product_id.required' => 'يجب حفظ البيانات الاساسية اولا',

        ]);
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');


            $values = [];
            if ($request->input('show') == 1) {
                $values['show'] = 1;
            } else {
                $values['show'] = 0;
            }
            Product_rate::findOrFail($id)->update($values);
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->back()->with('flash_success', 'تم الحفظ بنجاح');
        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

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
        $row = Product_rate::where('id', '=', $id)->first();

        try {
            $row->delete();

        } catch (QueryException $q) {


                return redirect()->back()->with('flash_danger','هذا المنتج مرتبط بجدول اخر');

            }
                return redirect()->route($this->routeName.'index')->with('flash_success', ' تم الحذف بنجاح!');

    }
}
