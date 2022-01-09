<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HomeSliderResource;
use App\Http\Resources\ProResource;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Home_slider;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function allProduct(){
        $products = Product::get();

        return $this->sendResponse(ProductResource::collection($products), 'All products Retrieved  Successfully');
    }
    public function index($id){
        $products = Product::where('category_id',$id)->get();

        return $this->sendResponse(ProductResource::collection($products), 'All products Retrieved  Successfully');
    }
    public function homeSlider(){
        $home=Home_slider::where('active',1)->orderBy("order", "Desc")->get();
        return $this->sendResponse(HomeSliderResource::collection($home), 'All Home Images Retrieved  Successfully');

    }

//GET ALL CATEGORIES
    public function categories(){
        $categories = Category::get();
        return $this->sendResponse(CategoryResource::collection($categories), 'All categories Retrieved  Successfully');
    }
    //GET LATEST PRODUCT
    public function latest(){
        $products = Product::take(10)->get();
        return $this->sendResponse(ProductResource::collection($products), 'Last 10 product Retrieved  Successfully');
    }
//GET SUB CATEGORY
public function subCategories($id){
    $subCategories = Category::where('parent_category_id','=',$id)->get();
    if($subCategories && !empty($subCategories)){
        return $this->sendResponse($subCategories, 'All Sub categories Retrieved  Successfully');

    }else{
        return $this->sendError('Error', 'No data found !!');

    }
}

//SEARCH
public function search($str){
    if($str) {
        $search = $str;

        $products=Product::where('ar_name','LIKE',"%$search%")->orWhere('en_name','LIKE',"%$search%")
        ->orwhereHas('category', function ($query) use ($search){
            $query->where('ar_name','LIKE',"%$search%")->orWhere('en_name','LIKE',"%$search%");
        })->get();
        return $this->sendResponse(ProductResource::collection($products), 'All Search result Retrieved  Successfully');
    }else{
        return $this->sendError('Error', 'Enter Search name !!');
    }
}


public function single_product($id){


    try
    {
        $product=Product::with('sizes','color','details','review')->where('id','=',$id)->first();
        $product->rate=$product->avgRating();
        $product->images=$product->images;
        if($product){

            return $this->sendResponse(ProductResource::make($product), 'Geting Product successfully.');
        }
        else
        {
            return $this->sendError('Invalid Product !');
        }
    } catch (\Exception $e) {
        return $this->sendError($e->getMessage(), 'Error happens!!');
    }
}


}
