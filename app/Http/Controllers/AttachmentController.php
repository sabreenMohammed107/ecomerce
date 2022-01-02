<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
class AttachmentController extends Controller
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
    public function __construct(Product $object)
    {
        $this->middleware('auth');
        // $this->middleware('permission:products-list|create|edit|delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete', ['only' => ['destroy']]);
        $this->object = $object;
        $this->viewName = 'admin.product.';
        $this->routeName = 'product.';
    }
    /**
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

            $data = [

                'product_id' => $request->get('product_id'),

            ];
            if ($request->hasFile('img')) {
                $attach_image = $request->file('img');

                $data['img'] = $this->UplaodImage($attach_image);

            }
            // dd($request->get('regulation_end_date'));
            $image = Image::create($data);
            $product = Product::where('id', $request->get('product_id'))->first();
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $product->images()->save($image);
            return redirect()->back()->with('flash_success', 'تم الحفظ بنجاح');

        } catch (\Throwable $e) {
            // throw $th;
            DB::rollback();
            // return redirect()->back()->withInput()->with('flash_danger', 'حدث خطأ الرجاء معاودة المحاولة في وقت لاحق');

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

            $data = [

                'product_id' => $request->get('product_id'),

            ];
            if ($request->hasFile('img')) {
                $attach_image = $request->file('img');

                $data['img'] = $this->UplaodImage($attach_image);

            }
            // dd($request->get('regulation_end_date'));
            $image = Image::findOrFail($id);
            $image->update($data);
            $product = Product::where('id', $request->get('product_id'))->first();
            DB::commit();
            // Enable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // $product->images()->save($image);
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
        $row = Image::findOrFail($id);

        $file = $row->img;

        $file_name = public_path('uploads/attachment/' . $file);
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
        $uploadPath = public_path('uploads/attachment');

        // Move The image..
        $file->move($uploadPath, $imageName);

        return $imageName;
    }

}
