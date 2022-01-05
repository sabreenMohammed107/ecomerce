<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact_message;
use App\Models\News_letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang as Lang;
class ContactUsController extends Controller
{
    protected $viewName = 'web.';
    const stage_1 = 'message.failed';
    public function index()
    {

        return view($this->viewName . 'contact');
    }
    public function sendMessage(Request $request){
        Contact_message::create($request->except('_token'));

        \Session::flash('flash_success', Lang::get('links.controller_message'));
        return view($this->viewName.'confirm');
        // ->with('flash_success', Lang::get('links.controller_message'));
        // return redirect()->route('contact')->with('flash_success', Lang::get('links.controller_message'));
    }

    public function sendLetter(Request $request){
        News_letter::create($request->except('_token'));
        return redirect()->back()->with('flash_success', Lang::get('links.controller_message_sub'));
    }
}
