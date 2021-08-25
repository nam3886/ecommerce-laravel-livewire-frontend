<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Tag;
use Livewire\Component;

class BlogComponent extends Component
{
    public function render()
    {
        $articles = Article::with('author')->paginate();

        $tags = Tag::whereActive(1)->has('articles')->get();

        return view('livewire.blog-component', compact('articles', 'tags'));
    }
}
