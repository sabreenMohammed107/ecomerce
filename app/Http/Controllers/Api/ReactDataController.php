<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HomeSliderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProResource;
use App\Models\Category;
use App\Models\Home_slider;
use App\Models\Product;

class ReactDataController extends BaseController
{

    public function home(){
        $page = [];

        $home=Home_slider::where('active',1)->orderBy("order", "Desc")->get();

        $page['home_slider'] = HomeSliderResource::collection($home);
        $categories = Category::get();
        $page['categories'] = CategoryResource::collection($categories);
        $products = Product::take(8)->get();
        $page['products'] = ProResource::collection($products);
        $offers = Product::whereNotNull('discount')->get();
        $page['offers'] = ProResource::collection($offers);

        return $this->sendResponse($page, "get all home data ");
    }
}
