<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Models\Company;
use App\Models\Company_contact;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        // $company =Company::where('id', '=',1)->firstOrFail();
        // $contact = Company_contact::where('id', 1)->first();
        // $categories=Category::orderBy("order", "Desc")->get();
        // dd($categories);
        //  View::share(['categories' => $categories]);

    }
}
