<?php

namespace App\Http\Livewire\Partials;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class SearchComponent extends Component
{
    public string $search   =   '';
    protected $queryString  =   [
        'search' => [
            'except' => ''
        ]
    ];

    public function render()
    {
        $products = empty($this->search) ? collect() : Product::search($this->search)
            ->select('name', 'slug')
            ->take(config('settings.get_search_result'))
            ->get();

        $categories = empty($this->search) ? collect() : Category::search($this->search)
            ->select('name', 'slug')
            ->take(config('settings.get_search_result'))
            ->get();

        $brands = empty($this->search) ? collect() : Brand::search($this->search)
            ->select('name', 'slug')
            ->take(config('settings.get_search_result'))
            ->get();

        return view('partials.themes.quick-search', compact('products', 'categories', 'brands'));
    }

    public function search()
    {
        if (trim($this->search)) {
            return redirect()->route('shop', [
                'search' => $this->search,
            ]);
        }
    }
}
