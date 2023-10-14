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
        $products = Product::where('category_id',$id)->get();

        return $this->sendResponse(ProductResource::collection($products), 'All products Retrieved  Successfully');
    }


 /**
     * Display ta listing of the Products ByFilter.
     *
     *
     * @return json Response
     */
    public function fetch_product(Request $request)
    {
        // dd($request->all());
        \Log::info($request->all());


            $filtters = Product::where('category_id', $request->get('category'));

            if (!empty($request->get("sizes"))) {

                $filtters->with('sizes')->whereHas('sizes', function ($query) use ($request) {
                    $query->whereIn('product_sizes.id', $request->get("sizes"));
                });
            }
            if (!empty($request->get("colors"))) {
                $filtters->whereHas('color', function ($query) use ($request) {
                    $query->whereIn('product_colors.id', $request->get("colors"));
                });
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
