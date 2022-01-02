<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Home_slider;
use App\Models\Product;

use Illuminate\Database\Eloquent\Collection;

class IndexController extends Controller
{
    protected $viewName='web.';
    public function index(){
        $latestProduct= array();
        $offers=array();
        $homeSliders = Home_slider::where('active',1)->orderBy("order", "Desc")->get();
        $categories=Category::with('images')->orderBy("order", "Desc")->get();
        $latest=Product::take(8)->orderBy("created_at", "Desc")->get();
        $productsOffers=Product::whereNotNull('discount')->orderBy("created_at", "Desc")->get();

        foreach ($latest as $product) {
            $product->rate=$product->avgRating();
            //get first img
            $product->images=$product->images->first();
            array_push($latestProduct, $product);
        }

        foreach ($productsOffers as $product) {
            $product->rate=$product->avgRating();
            $product->images=$product->images->first();
            array_push($offers, $product);
        }
        $blogs=Article::take(4)->orderBy("created_at", "Desc")->get();
        return view($this->viewName.'index',compact('homeSliders','categories','latestProduct','offers','blogs'));
    }
}
