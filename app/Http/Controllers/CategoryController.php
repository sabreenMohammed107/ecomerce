<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
class CategoryController extends Controller
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
   public function __construct(Category $object)
   {
       $this->middleware('auth');
      //  $this->middleware('permission:products-list|products-create|products-edit|products-delete', ['only' => ['index', 'show']]);
      //  $this->middleware('permission:products-create', ['only' => ['create', 'store']]);
      //  $this->middleware('permission:products-edit', ['only' => ['edit', 'update']]);
      //  $this->middleware('permission:products-delete', ['only' => ['destroy']]);
       $this->object = $object;
       $this->viewName = 'admin.category.';
       $this->routeName = 'category.';
   } /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows=Category::orderBy("created_at", "Desc")->get();


        return view($this->viewName.'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attachments=[];

        return view($this->viewName.'add', compact('attachments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->validate($request, [
            'ar_name' => 'required',
            'en_name' => 'required',
            'img'=>'required',


    ], [

        'ar_name.required' => 'حقل الاسم مطلوب',
        'en_name.required' => 'حقل الاسم مطلوب',
        'img.required' => 'حقل الصورة مطلوب',

    ]);

        $values = array_except($request->all(), ['_token','img']);


       $category= $this->object::create($values);
       if ($request->hasFile('img')) {
        $attach_image = $request->file('img');

        $data['img'] = $this->UplaodImage($attach_image);
        // dd($request->get('regulation_end_date'));
    $image = Image::create($data);
    $category->images()->save($image);

    }

      DB::commit();
      // Enable foreign key checks!
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->route($this->routeName . 'edit', $category->id)->with('flash_success','تم الحفظ بنجاح');
    } catch (\Throwable $e) {
        DB::rollback();

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
        $category = Category::where('id', '=', $id)->first();
        $attachments=$category->images;

        return view($this->viewName . 'edit', compact('category', 'attachments'));

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


    ], [

        'ar_name.required' => 'حقل الاسم مطلوب',
        'en_name.required' => 'حقل الاسم مطلوب',

    ]);
    DB::beginTransaction();
        try
        {
            // Disable foreign key checks!
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $values = array_except($request->all(), ['_token']);


        $this->object::findOrFail($id)->update($values);
        $category=Category::findOrFail($id);
        if ($request->hasFile('img')) {
            $attach_image = $request->file('img');

            $data['img'] = $this->UplaodImage($attach_image);
            $image = Image::create($data);
            $category->images()->sync($image);
        }
        // dd($request->get('regulation_end_date'));

          DB::commit();
          // Enable foreign key checks!
          DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect()->route($this->routeName . 'edit', $id)->with('flash_success','تم الحفظ بنجاح');
    } catch (\Throwable $e) {
        DB::rollback();

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
        $row = Category::where('id', '=', $id)->first();

        try{
            $row->delete();


            }
            catch(QueryException $q){

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
