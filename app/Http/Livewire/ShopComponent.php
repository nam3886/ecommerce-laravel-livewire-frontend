<?php

namespace App\Http\Livewire;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ShopComponent extends Component
{
    use WithPagination;

    public          $search, $category, $tag, $brand; // for query string
    public          $brands, $attributes, $categories, $tags;
    public          $availableAttributes;
    public int      $minPrice, $maxPrice;
    public int      $order      =   0;
    public array    $filters    =   [];

    protected $queryString      =   [
        'search'                =>  ['except' =>  ''],
        'category'              =>  ['except' =>  ''],
        'tag'                   =>  ['except' =>  ''],
        'brand'                 =>  ['except' =>  ''],
    ];

    public function mount(): void
    {
        $this->tags = cache()->rememberForever('shop_tags', function () {
            return Tag::whereActive(1)->has('products')->get();
        });

        $this->categories = cache()->rememberForever('shop_categories', function () {
            return Category::select('id', 'name', 'slug')
                ->with(['children' => fn ($query) => $query->has('products')])
                ->whereActive(1)
                ->whereNull('parent_id')
                ->has('products')
                ->get();
        });

        $this->brands = cache()->rememberForever('shop_brands', function () {
            return Brand::select('id', 'name', 'slug')
                ->withCount('products')
                ->has('products')
                ->get()
                ->toArray();
        });

        $this->attributes = cache()->rememberForever('shop_attributes', function () {
            return Attribute::select('id', 'code', 'name')
                ->whereActive(1)
                ->whereIsFilterable(1)
                ->with(['values' => fn ($query) => $query->has('variants')])
                ->get()
                ->toArray();
        });

        $this->availableAttributes = collect($this->attributes)->pluck('code')->toArray();
        array_push($this->availableAttributes, 'price', 'brand');
        $this->maxPrice = Product::max('price');
        $this->minPrice = Product::min('price');
        $this->brand && $this->filters['brand'][] = $this->brand;
    }

    public function render(): View
    {
        $products = $this->getDataSearchValues();
        return view('livewire.shop-component', compact('products'));
    }

    public function paginationView(): string
    {
        return 'components.partials.custom-pagination-links-view';
    }

    public function updatedFilters(): void
    {
        $this->resetPage();
    }

    public function assignNewFilters(array $filters): void
    {
        $this->syncInput('filters', $filters);
    }

    private function getDataSearchValues(): LengthAwarePaginator
    {
        $order = $this->getOrder();
        $query = Product::search($this->search)
            ->with('gallery', 'discount')
            ->withAvg('comments', 'star')
            ->withCount('comments');

        $this->queryUrlParams($query);
        $this->queryAttributes($query);

        return $query->orderBy($order[0], $order[1])->paginate(config('settings.pagination'));
    }

    private function getOrder(): array
    {
        return match ($this->order) {
            1       =>  ['name', 'asc'],
            2       =>  ['name', 'desc'],
            3       =>  ['price', 'asc'],
            4       =>  ['price', 'desc'],
            5       =>  ['view', 'desc'],
            default =>  ['created_at', 'desc'],
        };
    }

    private function queryAttributes(Builder &$query): Builder
    {
        foreach ($this->filters as $key => $value) {
            if (!in_array($key, $this->availableAttributes) || empty($value)) continue;

            switch ($key) {
                case 'price':
                    $query->whereBetween('price', $value);
                    break;
                case 'brand':
                    $query->whereIn('brand_id', $value);
                    break;
                default:
                    $query->whereHas('variants', function ($query) use ($value) {
                        $query->whereHas('attributeValues', function ($query) use ($value) {
                            $query->whereIn('attribute_values.id', $value);
                        });
                    });
                    break;
            }
        }
        return $query;
    }

    private function queryUrlParams(Builder &$query): Builder
    {
        $queryStrings = ['category', 'tag'];

        foreach ($queryStrings as $queryString) {

            if (empty($this->$queryString)) continue;

            $relation = Str::plural($queryString);

            $query->whereHas($relation, function ($query) use ($queryString) {
                $query->where('slug', $this->$queryString);
            });
        }

        return $query;
    }
}
