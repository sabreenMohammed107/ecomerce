<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $viewName = 'web.';
    public function index($id)
    {
        $products = Product::where('category_id', $id)->paginate(2);
        $category = Category::where('id', $id)->first();
        $sizes = Size::all();
        $colors = Color::all();
        $maxPrice = Product::where('category_id', $id)->max('price_after_discount');
        $rangeArray = range(0, $maxPrice, 100);
        //  dd($rangeArray);
        return view($this->viewName . 'products', compact('products', 'category', 'sizes', 'colors', 'rangeArray'));
    }

    public function fetch_data(Request $request)
    {
        $filtters = Product::where('category_id', $request->get('category'));

        if (!empty($request->get("sizes"))) {
            $filtters->whereHas('sizes', function ($query) use ($request) {
                $query->whereIn('product_sizes.id', $request->get("sizes"));
            });
        }
        if (!empty($request->get("colors"))) {
            $filtters->whereHas('color', function ($query) use ($request) {
                $query->whereIn('product_colors.id', $request->get("colors"));
            });
        }

        if (!empty($request->get("prices"))) {
            $filtters->whereIn('price_after_discount', '<=', $request->get("prices"));
        }
        if (!empty($request->get("prices"))) {
            $filtters->whereIn('price_after_discount', '>=', $request->get("prices")[0]);
        }

        $products = $filtters->paginate(2);
        $category = Category::where('id', $request->get('category'))->first();

        return view('web.productList', compact('products','category'))->render();

    }
    public function fetch_product(Request $request)
    {
        // dd($request->all());
        \Log::info($request->all());

        if ($request->ajax()) {
            $filtters = Product::where('category_id', $request->get('category'));

            if (!empty($request->get("sizes"))) {

                $filtters->with('sizes')->whereHas('sizes', function ($query) use ($request) {
                    $query->whereIn('product_sizes.id',$request->get("sizes"));
                });
            }
            if (!empty($request->get("colors"))) {
                $filtters->whereHas('color', function ($query) use ($request) {
                    $query->whereIn('product_colors.id', $request->get("colors"));
                });
            }

            if (!empty($request->get("prices"))) {
                $filtters->whereIn('price_after_discount', '<=', $request->get("prices"));
            }
            // if (!empty($request->get("prices"))) {
            //     $filtters->whereIn('price_after_discount', '>=', $request->get("prices")[0]);
            // }

            $products = $filtters->paginate(2);

            return view($this->viewName . 'productList', compact('products'))->render();
        }
    }

    public function singleProduct($id){
        $product=Product::where('id', $id)->first();

        return view($this->viewName.'single-product',compact('product'));
    }
}
