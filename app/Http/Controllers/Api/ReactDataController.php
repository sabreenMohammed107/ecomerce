<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\HomeSliderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProResource;
use App\Http\Resources\SizeResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Home_slider;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ReactDataController extends BaseController
{

    /**
    *  Display a listing of the data in home page.
    *
    * @return json Response
    */
    public function home(){
        $page = [];

        $home=Home_slider::where('active',1)->orderBy("order", "Desc")->get();

        $page['home_slider'] = HomeSliderResource::collection($home);
        $categories = Category::get();
        $page['categories'] = CategoryResource::collection($categories);
        $products = Product::take(8)->get();
        $page['products'] = ProductResource::collection($products);
        $offers = Product::whereNotNull('discount')->get();
        $page['offers'] = ProductResource::collection($offers);

        return $this->sendResponse($page, "get all home data ");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return json Response
     */
    public function singlePro($id){


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

    /**
     * Display ta listing of the data.
     *
     * @param  string  $str
     * @return json Response
     */
    public function search(Request $request){
        if($request->get('str')) {
            $search = $request->get('str');

            $products=Product::where('ar_name','LIKE',"%$search%")->orWhere('en_name','LIKE',"%$search%")
            ->orwhereHas('category', function ($query) use ($search){
                $query->where('ar_name','LIKE',"%$search%")->orWhere('en_name','LIKE',"%$search%");
            })->get();
            return $this->sendResponse(ProductResource::collection($products), 'All Search result Retrieved  Successfully');
        }else{
            return $this->sendError('Error', 'Enter Search name !!');
        }
    }

 /**
     * Display ta listing of the Products By Category Id.
     *
     * @param  int  $id
     * @return json Response
     */
    public function ProductsByCat($id){
        $page = [];
        $products = Product::where('category_id',$id)->get();
        $page['products'] = ProductResource::collection($products);
        $sizes = Size::get();
        $colors = Color::get();
        $page['sizes'] = SizeResource::collection($sizes);
        $page['colors'] = ColorResource::collection($colors);
        return $this->sendResponse($page, "get all products data ");
    }


 /**
     * Display ta listing of the Products ByFilter.
     *
     *
     * @return json Response
     */
    public function fetch_product(Request $request)
    {
         dd($request->all());


            $filtters = Product::where('category_id', $request->get('category'));

            if (!empty($request->get("sizes"))) {
                $r = json_decode($request->get("sizes"), true);
                if (count($r) > 0) {

                    $filtters->with('sizes')->whereHas('sizes', function ($query) use ($r) {
                        $query->whereIn('product_sizes.id', $r);
                    });
                }

            }
            if (!empty($request->get("colors"))) {
                $c = json_decode($request->get("colors"), true);
                if (count($c) > 0) {

                    $filtters->whereHas('color', function ($query) use ($c) {
                        $query->whereIn('product_colors.id', $c);
                    });
                }

            }

            if (!empty($request->get("prices"))) {
                // $filtters->whereIn('price_after_discount', '<=', $request->get("prices"));
               $filtters->where('price_after_discount', '<=', (double) $request->get("prices")[0]);
                $filtters->where('price_after_discount', '>=', (double) $request->get("prices")[0] - 100);
                //$filtters->whereBetween('price_after_discount', $request->get("prices"));
            }
            // if (!empty($request->get("prices"))) {
            //     $filtters->whereIn('price_after_discount', '>=', $request->get("prices")[0]);
            // }

            $products = $filtters->get();

            return $this->sendResponse(ProductResource::collection($products), 'All products Retrieved  Successfully');


    }
}
