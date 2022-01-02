<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ClientController extends Controller
{
     // This is for General Class Variables.
     protected $model;
     protected $view = 'admin.clients.';
     protected $route = "clients.";

     /**
      * UserController Constructor.
      *
      * @return \Illuminate\Http\Response
      */
     public function __construct(User $model)
     {
         $this->middleware('auth');
         // $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index','show']]);
         // $this->middleware('permission:users-create', ['only' => ['create','store']]);
         // $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:users-delete', ['only' => ['destroy']]);
         $this->model = $model;
     }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model::where('user_type',1)->get();

        return view($this->view.'index', compact('data'));
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
        $data = $this->model::findOrFail($id);

        return view($this->view.'show', compact('data'));
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
        try
        {
            $account = $this->model::findOrFail($id);
            $account->delete();

            // Display a successful message ...
            return redirect()->route($this->route.'index')->with('flash_success','تم حذف بيانات العميل بنجاح');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            // Display a successful message ...
            return redirect()->route($this->route.'index')->with('flash_danger','خطأ ... لا يمكن الحذف حتي لا تتأثر البيانات الأخري بعملية الحذف !!!');
        }
    }
}
