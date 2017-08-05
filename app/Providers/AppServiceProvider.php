<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Slide;
use App\Category;
use Cart;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        // load category den file top-menu.blade.php va category
        view()->composer(['client.layout.top-menu','client.layout.category','client.layout.footer'],function($view){
            $cartItem = Cart::content();
            $category = Category::all();
            $view->with(['category'=>$category,'cartItem'=>$cartItem]);
        });
        // load slide den file slide.blade.php
        view()->composer('client.layout.slide',function($view){
            $slide = Slide::all();
            $view->with('slide',$slide); 
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
