<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Product_rate;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $viewName = 'web.';

    public function index($id)
    {
        $products = Product::where('category_id', $id)->paginate(6);
        $category = Category::where('id', $id)->first();
        $sizes = Size::all();
        $colors = Color::all();
        $maxPrice = Product::where('category_id', $id)->max('price_after_discount') + 100;
        $rangeArray = range(0, $maxPrice, 100);
        //  dd($rangeArray);
        return view($this->viewName . 'products', compact('products', 'category', 'sizes', 'colors', 'rangeArray'));
    }

    public function search(Request $request){
       $search=$request->get('searchName');

    //    $products = Product::where('category_id', $id)->paginate(6);
       $products=Product::where('ar_name','LIKE',"%$search%")->orWhere('en_name','LIKE',"%$search%")
       ->paginate(6);
            $category = null;
            $sizes = Size::all();
            $colors = Color::all();
            $maxPrice = Product::max('price_after_discount') + 100;
            $rangeArray = range(0, $maxPrice, 100);
            //  dd($rangeArray);
            return view($this->viewName . 'search', compact('products', 'category', 'sizes', 'colors', 'rangeArray'));

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

        $products = $filtters->paginate(6);
        $category = Category::where('id', $request->get('category'))->first();

        return view('web.productList', compact('products', 'category'))->render();

    }

    public function fetch_Search(Request $request)
    {
        $filtters = Product::orderBy("id", "Desc");

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

        $products = $filtters->paginate(6);


        return view('web.searchList', compact('products'))->render();

    }
    public function fetch_product(Request $request)
    {
        // dd($request->all());
        \Log::info($request->all());

        if ($request->ajax()) {
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

            }
            // if (!empty($request->get("prices"))) {
            //     $filtters->whereIn('price_after_discount', '>=', $request->get("prices")[0]);
            // }

            $products = $filtters->paginate(6);

            return view($this->viewName . 'productList', compact('products'))->render();
        }
    }
public function fetchProductSearch(Request $request){
    \Log::info($request->all());

    if ($request->ajax()) {
        $filtters = Product::orderBy("id", "Desc");

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

        }
        // if (!empty($request->get("prices"))) {
        //     $filtters->whereIn('price_after_discount', '>=', $request->get("prices")[0]);
        // }

        $products = $filtters->paginate(6);

        return view($this->viewName . 'searchList', compact('products'))->render();
    }
}
    public function singleProduct($id)
    {
        // $product = Product::has('images')->where('id', 3)->first();
        // $category = Category::where('id', 3)->first();
        $row = Product::find($id);
        $images = Image::all();
        $related = array();
        $proRelates = Product::orderBy("created_at", "Desc")->get();
        foreach ($proRelates as $product) {
            $product->rate = $product->avgRating();
            // $product->images = $product->images->first();
            array_push($related, $product);
        }
        return view($this->viewName . 'single-product', compact('row', 'images', 'related'));
    }

    public function leaveComment($id)
    {
        $product = Product::where('id', $id)->first();
        return view('web.leaveComment', compact('product'));
    }

    public function saveComment(Request $request)
    {
        $input = [
            'product_id' => $request->get('product_id'),
            'user_id' => $request->get('user_id'),
            'rate_no' => $request->get('rate_no'),
            'ar_comment' => $request->get('ar_comment'),
            'en_comment' => $request->get('ar_comment'),
        ];
        Product_rate::create($input);
        //return
        $row = Product::find($request->get('product_id'));
        $images = Image::all();
        $related = array();
        $proRelates = Product::orderBy("created_at", "Desc")->get();
        foreach ($proRelates as $product) {
            $product->rate = $product->avgRating();
            // $product->images = $product->images->first();
            array_push($related, $product);
        }

        return redirect()->intended('/single-product/'.$request->get('product_id'));
        // return view($this->viewName . 'single-product', compact('row', 'images', 'related'));

    }
}
