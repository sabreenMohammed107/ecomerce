<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Home_slider;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Database\QueryException;
class HomeSliderController extends Controller
{
    // This is for General Class Variables.
    protected $object;
    protected $viewName;
    protected $routeName;

    /**
     * UserController Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Home_slider $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:products-list|create|edit|delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.home-slider.';
        $this->routeName = 'admin-slider.';
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Home_slider::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows'));
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

        return view($this->viewName . 'add', compact('categories', 'products'));

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
            'img' => 'required',
            'ar_title' => 'required',
            'en_title' => 'required',

        ], [

            'img.required' => 'حقل الصورة مطلوب',
            'ar_title.required' => 'حقل العنوان مطلوب',
            'en_title.required' => 'حقل العنوان مطلوب',

        ]);
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $data = [

                'en_title' => $request->get('en_title'),
                'ar_title' => $request->get('ar_title'),
                'en_text' => $request->get('en_text'),
                'ar_text' => $request->get('ar_text'),
                'order' => $request->get('order'),

            ];
            if ($request->hasFile('img')) {
                $attach_image = $request->file('img');

                $data['image'] = $this->UplaodImage($attach_image);

            }
            if ($request->get('tab') == 'igotnone') {

                $data['category_id'] = $request->get('category_id');
                $data['product_id'] = null;

            } else {

                $data['category_id'] = null;
                $data['product_id'] = $request->get('product_id');

            }
            // dd($request->get('regulation_end_date'));
            $image = Home_slider::create($data);
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->back()->with('flash_success', 'تم الحفظ بنجاح');

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        } //master

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
        $row=Home_slider::where('id',$id)->first();
        $categories = Category::all();
        $products = Product::all();

        return view($this->viewName . 'edit', compact('row','categories', 'products'));
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
            'ar_title' => 'required',
            'en_title' => 'required',

        ], [

            'ar_title.required' => 'حقل العنوان مطلوب',
            'en_title.required' => 'حقل العنوان مطلوب',

        ]);
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            $data = [

                'en_title' => $request->get('en_title'),
                'ar_title' => $request->get('ar_title'),
                'en_text' => $request->get('en_text'),
                'ar_text' => $request->get('ar_text'),
                'order' => $request->get('order'),

            ];
            if ($request->hasFile('img')) {
                $attach_image = $request->file('img');

                $data['image'] = $this->UplaodImage($attach_image);

            }
            if ($this->object::findOrFail($id)->category_id != null) {

                $data['category_id'] = $request->get('category_id');
                $data['product_id'] = null;

            } else {

                $data['category_id'] = null;
                $data['product_id'] = $request->get('product_id');

            }
            // dd($request->get('regulation_end_date'));
            $this->object::findOrFail($id)->update($data);
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->back()->with('flash_success', 'تم الحفظ بنجاح');

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

            return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
        } //master

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Home_slider::findOrFail($id);

        $file = $row->img;

        $file_name = public_path('uploads/home_sliders/' . $file);
        try {
            $row->delete();
            File::delete($file_name);

        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger','هذا المنتج مرتبط بجدول اخر');

        }
            return redirect()->route($this->routeName.'index')->with('flash_success', ' تم الحذف بنجاح!');
    }

    /* uplaud image
     */
    public function UplaodImage($file_request)
    {
        //  This is Image Info..
        $file = $file_request;
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $path = $file->getRealPath();
        $mime = $file->getMimeType();
        // Rename The Image ..
        $imageName = $name;
        $uploadPath = public_path('uploads/home_sliders');

        // Move The image..
        $file->move($uploadPath, $imageName);

        return $imageName;
    }

}
