<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticleComponent extends Component
{
    public Article $article;

    public function mount(string $slug)
    {
        $this->article  =   Article::with('author', 'tags')
            ->whereActive(1)
            ->whereSlug($slug)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.article-component');
    }
}
