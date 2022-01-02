<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Company_contact;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //shared
        $categories=Category::orderBy("order", "Desc")->get();
        $contact = Company_contact::where('id', 1)->first();
        view()->share(['categories' => $categories,'contact'=>$contact]);

    }
}
