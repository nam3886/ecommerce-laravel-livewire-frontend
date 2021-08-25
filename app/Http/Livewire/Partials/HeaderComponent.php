<?php

namespace App\Http\Livewire\Partials;

use App\Models\Menu;
use Livewire\Component;

class HeaderComponent extends Component
{
    public bool $isMobile = false;

    public function render()
    {
        $theme = $this->isMobile ? 'mobile-header' : 'normal-header';
        $menus = cache()->rememberForever('menu_header', function () {
            return Menu::with('category', 'children')
                ->whereActive(1)
                ->get()
                ->groupBy('parent_id')
                ->reduce(function ($carry, $item, $key) {
                    $carry[$key ? $key : 'root'] = $item;
                    return $carry;
                }, []);
        });

        return cache()->rememberForever(
            'view_header_' . $theme . auth()->id(),
            fn () => view("partials.themes.{$theme}")->with('menus', $menus)->render()
        );
    }
}
