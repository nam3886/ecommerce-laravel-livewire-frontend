<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProductComponent extends Component
{
    public Product $product;
    public Collection $relatedProducts;

    public function mount(string $slug)
    {
        $this->product = $this->getProduct($slug);
        $this->relatedProducts = $this->getRelatedProducts();
    }

    public function render()
    {
        return view('livewire.product-component');
    }

    private function getProduct(string $slug): Product
    {
        return cache()->rememberForever("product_detail_{$slug}", function () use ($slug) {
            return Product::with('tags', 'gallery', 'discount')
                ->withAvg('comments', 'star')
                ->withCount('comments')
                ->whereSlug($slug)
                ->firstOrFail();
        });
    }

    private function getRelatedProducts(): Collection
    {
        $tags = $this->product->tags->pluck('id');

        return cache()->rememberForever(
            "product_related_{$this->product->slug}",
            function () use ($tags) {
                return Product::with(['gallery', 'discount'])
                    ->active()
                    ->whereBrandId($this->product->brand_id)
                    ->orWhereHas('tags', fn ($query) => $query->whereIn('tags.id', $tags))
                    ->inRandomOrder()
                    ->take(config('settings.get_related_products'))
                    ->get()
                    ->except($this->product->id);
            }
        );
    }
}
