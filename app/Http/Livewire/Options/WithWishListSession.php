<?php

namespace App\Http\Livewire\Options;

use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Http\Livewire\Message;
use App\Models\Product;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Gloudemans\Shoppingcart\Facades\Cart;
use InvalidArgumentException;
use Illuminate\Support\Str;

/**
 *  Actions: add, remove
 *  Will display notification(after processing or when error)
 *  Will emit event and return void if successful processing
 */
trait WithWishListSession
{
    use WithNotifyMsgUi;

    private string  $instance           =   'wishlist';
    private string  $associate          =   '\App\Models\Product';
    private string  $voucherSessionKey  =   'voucher_code';
    protected string $eventEmptyCart    =   'empty-cart';

    protected function getWishListInfo()
    {
        $wishlist       =   $this->wishlist();

        return (object) [
            'content'   =>  $wishlist->content(),
            'count'     =>  $wishlist->count(),
        ];
    }

    protected function addWishList(Product $product, int $quantity)
    {
        $isExist = $this->wishlist()
            ->search(fn ($item) =>  $item->id === $product->id)->count();

        if ($isExist) {
            return $this->flashMessage(Message::ITEM_EXIST_WISH_LIST, 'error');
        }

        try {
            $this->wishlist()->add([
                'id'                    =>  $product->id,
                'name'                  =>  $product->name,
                'price'                 =>  $product->price_after_discount,
                'qty'                   =>  $quantity,
                'weight'                =>  1,
                'options'               =>  [
                    'slug'              =>  $product->slug,
                    'image'             =>  $product->gallery->avatarString(),
                ],
            ])->associate($this->associate);

            $this->flashMessage(Str::limit($product->name, 30, '...') . Message::ADD_WISH_LIST_SUCCESS);

            $this->emitEvents();
        } catch (\Throwable $th) {
            $this->handleExceptionWishList($th);

            return 'error';
        }
    }

    protected function removeWishList(string $wishlistId)
    {
        try {
            $this->wishlist()->remove($wishlistId);

            $this->flashMessage(Message::REMOVE_WISH_LIST_SUCCESS, 'warning');

            $this->emitEvents();
        } catch (\Throwable $th) {
            $this->handleExceptionWishList($th);

            return 'error';
        }
    }

    /**
     * Events will emit after successful processing
     */
    private function emitEvents()
    {
        $this->emitTo('partials.quick-view-wish-list-component', 'wish-changed');
        $this->emitTo('partials.count-wish-list-component', 'wish-changed');
        $this->emitTo('wish-list-component', 'wish-changed');
    }

    /**
     * define instance of cart
     */
    private function wishlist()
    {
        return Cart::instance($this->instance);
    }

    private function handleExceptionWishList(\Throwable $e)
    {
        switch ($e) {
            case $e instanceof InvalidRowIDException:
                return $this->flashMessage(Message::INVALID_WISH_LIST_EX, 'error');

            case $e instanceof InvalidArgumentException:
                return $this->flashMessage($e->getMessage(), 'error');

            default:
                throw $e;
        }
    }
}
