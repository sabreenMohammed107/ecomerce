<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Why_us;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    //
    protected $viewName='web.';
    public function index(){
        $company=Company::first();
        $whyRows=Why_us::get();
        return view($this->viewName.'about',compact('company','whyRows'));
    }
}
