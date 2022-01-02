<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Article_tag;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    protected $viewName='web.';
    public function index(){
        $latestProduct= array();
        $categories=Category::with('images')->orderBy("order", "Desc")->get();
        $latestPosts=Article::orderBy("created_at", "Desc")->take(3)->get();
        $blogs=Article::orderBy("created_at", "asc")->paginate(6);
        $tags=Tag::all();
        $BlogTags=Article_tag::pluck('tag_id')->all();
        return view($this->viewName.'blogs',compact('categories','latestPosts','blogs','tags','BlogTags'));
    }


    function fetch_data(Request $request)
            {


             if($request->ajax())
             {
                $blogs=Article::orderBy("created_at", "Desc")->paginate(6);

              return view($this->viewName.'blogList', compact('blogs'))->render();
             }
            }
}
