<?php

namespace App\Http\Livewire\Products;

use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Http\Livewire\Message;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class FeedbackComponent extends Component
{
    use WithNotifyMsgUi;

    public          $captcha;
    public Article  $article;
    public Product  $product;
    public array    $user       =   [];
    public array    $replies    =   [];
    public bool $isArticlePage  =   false;

    protected $rules        =   [
        'user.name'         =>  'required|min:3|max:255',
        'user.email'        =>  'required|email',
        'user.star'         =>  'nullable|integer|min:1|max:5',
        'user.content'      =>  'nullable|min:3|max:1024',
        'user.parent_id'    =>  'nullable|exists:App\Models\Comment,id',
    ];

    public function render()
    {
        $comments = Comment::with('replies', 'user')
            ->whereActive(1)
            ->whereNotNull('content')
            ->whereNull('parent_id');

        $comments = $this->isArticlePage
            ? $comments->whereArticleId($this->article->id)->get()
            : $comments->whereProductId($this->product->id)->get();

        $theme = $this->isArticlePage ? 'article' : 'product';

        return view("partials.themes.{$theme}-feedback", compact('comments'));
    }

    /**
     * allowed guest
     */
    public function review(int $star = 5): void
    {
        $this->verifyCaptcha();

        $this->user['star']     =   $star;
        $this->user['email']    =   $this->user['email'] ?? auth()->user()->email;
        $this->user['name']     =   $this->user['name'] ?? auth()->user()->name;

        $comment                =   $this->addNewComment();

        $this->flashMessage($comment->content ? Message::ADD_REVIEW : Message::ADD_RATING);
    }

    /**
     * not allowed guest
     */
    public function reply(int $parentId)
    {
        if (auth()->guest()) return redirect()->route('login');

        $this->user['email']        =   auth()->user()->email;
        $this->user['name']         =   auth()->user()->name;
        $this->user['content']      =   $this->user['reply'][$parentId];
        $this->user['parent_id']    =   $parentId;

        $this->addNewComment();
    }

    public function like(Comment $comment)
    {
        if (!auth()->check()) return redirect()->route('login');

        $userId     =   auth()->id();
        $listLiked  =   $comment->like_by_user_ids;

        if (!is_array($listLiked)) $listLiked = [];
        if (in_array($userId, $listLiked)) return;

        array_push($listLiked, $userId);
        $comment->like_by_user_ids  =   $listLiked;
        $comment->save();
    }

    public function unlike(Comment $comment): void
    {
        $userId = auth()->id();
        $comment->like_by_user_ids = array_diff($comment->like_by_user_ids, [$userId]);
        $comment->save();
    }

    /**
     * validate and add comment => reset user and replies variables
     * @return App\Models\Comment
     */
    private function addNewComment(): Comment
    {
        $this->validate();

        $comment                =   new Comment;
        $comment->user_id       =   auth()->id();
        $comment->fill($this->user);

        if ($this->isArticlePage) {
            $comment->article_id    =   $this->article->id;
        } else {
            $comment->product_id    =   $this->product->id;
        }

        $comment->save();
        $this->reset('user', 'replies', 'captcha');
        $this->dispatchBrowserEvent('reviewed');
        return $comment;
    }

    private function verifyCaptcha(): void
    {
        empty($this->captcha) && throw ValidationException::withMessages([
            'captcha' => 'The captcha field is required'
        ]);

        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . config('captcha.secret') . '&response=' . $this->captcha)->json();

        !$response['success'] && throw ValidationException::withMessages([
            'captcha' => collect($response['error-codes'])->first()
        ]);
    }
}
