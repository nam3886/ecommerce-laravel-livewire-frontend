<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Service;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $bannersSlider  =   cache()->rememberForever('home_banners_slider', function () {
            return Banner::wherePosition('slider')
                ->select('title', 'content', 'image')
                ->inRandomOrder()
                ->take(config('setting.get_image_slides', 3))
                ->get();
        });

        $bannersBody1   =   cache()->rememberForever('home_banners_body_1', function () {
            return Banner::wherePosition('body1')
                ->select('title', 'content', 'image')
                ->inRandomOrder()
                ->take(5)
                ->get();
        });

        $bannerBody2    =   cache()->rememberForever('home_banners_body_2', function () {
            return Banner::wherePosition('body2')
                ->select('title', 'content', 'image')
                ->inRandomOrder()
                ->first();
        });

        $brands         =   cache()->rememberForever('home_brands', function () {
            return Brand::withCount('products')
                ->select('id', 'slug', 'name', 'image')
                ->whereActive(1)
                ->has('products')
                ->take(config('setting.get_banner_brands', 4))
                ->inRandomOrder()
                ->get();
        });

        $newProducts    =   cache()->rememberForever('home_new_products', function () {
            return Product::with('gallery', 'discount')
                ->active()
                ->whereFlag('new')
                ->inRandomOrder()
                ->take(config('setting.get_new_products', 10))
                ->get();
        });

        $bestProducts   =   cache()->rememberForever('home_best_products', function () {
            return Product::with('gallery', 'discount')
                ->active()
                ->whereFlag('hot')
                ->inRandomOrder()
                ->take(config('setting.get_best_products', 6))
                ->get();
        });

        $services       =   cache()->rememberForever('home_services', function () {
            return Service::wherePosition('home')->get();
        });

        $articles       =   cache()->rememberForever('home_articles', function () {
            return Article::with('author')->latest()->take(4)->get();
        });

        return view('livewire.home-component', compact(
            'bannersSlider',
            'bannersBody1',
            'bannerBody2',
            'brands',
            'newProducts',
            'bestProducts',
            'services',
            'articles'
        ));
    }
}
