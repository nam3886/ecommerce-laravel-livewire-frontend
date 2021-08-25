<?php

namespace App\Http\Livewire\Options;

use App\Helpers\Currency;
use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Http\Livewire\Message;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Voucher;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Illuminate\Support\Str;

/**
 *  Actions: add, remove, change quantity
 *  Will display notification(after processing or when error)
 *  Will emit event and return void if successful processing
 */
trait WithCartSession
{
    use WithNotifyMsgUi;

    private string  $instance               =   'cart';
    private string  $associate              =   '\App\Models\Product';
    protected string  $voucherSessionKey    =   'voucher_code';
    protected string $eventEmptyCart        =   'empty-cart';

    protected function getCartInfo()
    {
        $cart = $this->cart();

        return (object) [
            'content'           =>  $cart->content(),
            'count'             =>  $cart->count(),
            'total_price'       =>  $cart->priceTotalFloat(),
            'discount'          =>  $cart->discountFloat(),
            'sub_total'         =>  $cart->subtotalFloat(),
            'tax'               =>  $cart->taxFloat(),
            'grand_total'       =>  $cart->totalFloat(),
        ];
    }

    protected function prepareData(Product $product, Variant $variant, int $quantity): array
    {
        return [
            'id'            =>  $product->id,
            'name'          =>  $product->name,
            'weight'        =>  $variant->weight,
            'price'         =>  $variant->price_after_discount,
            'qty'           =>  $quantity,
            'options'       =>  [
                'variant'   =>  $variant->name,
                'sku'       =>  $variant->sku,
                'slug'      =>  $product->slug,
                'length'    =>  $variant->length,
                'width'     =>  $variant->width,
                'height'    =>  $variant->height,
                'image'     =>  $product->gallery->avatarString(),
            ],
        ];
    }

    protected function addCart(int $stock, array $fields, ?callable $callback = null)
    {
        $item = $this->cart()
            ->search(fn ($item) =>  $item->options->sku === $fields['options']['sku'])
            ->first();

        // nếu hết hàng hoặc
        // không có item và số lượng item + input số lượng > hàng tồn
        if ($stock <= 0 || $item && ($item->qty +  $fields['qty'] > $stock)) {

            return $this->flashMessage(Message::OUT_OF_STOCK, 'error');
        }

        try {
            $this->cart()->add($fields)->associate($this->associate);
            $this->flashMessage(Str::limit($fields['name'], 30, '...') . Message::ADD_CART_SUCCESS);

            $price = Currency::autoFormatCurrency($this->getCartInfo()->total_price);

            $this->dispatchBrowserEvent('successful-add-cart', [
                'avatar'    =>  $fields['options']['image'],
                'count'     =>  $this->getCartInfo()->count,
                'total'     =>  $price,
            ]);

            $this->emitEvents();

            is_callable($callback) && $callback();
        } catch (\Throwable $th) {

            $this->handleExceptionCart($th);
            return 'error';
        }
    }

    protected function removeCart(string $cartId)
    {
        try {
            $this->cart()->remove($cartId);

            $this->flashMessage(Message::REMOVE_CART_SUCCESS);

            $this->emitEvents();

            $this->emitTo('products.detail-component', 'cart-changed');
            $this->emitTo('partials.quick-view-component', 'cart-changed');

            if (!$this->cart()->content()->count()) {
                session()->forget($this->voucherSessionKey);

                $this->emit($this->eventEmptyCart);
            };
        } catch (\Throwable $th) {
            $this->handleExceptionCart($th);

            return 'error';
        }
    }

    protected function changeQuantity(string $cartId, int $quantity)
    {
        try {
            $this->cart()->update($cartId, ['qty' => $quantity]);

            $this->flashMessage(Message::UPDATE_CART_SUCCESS);

            $this->emitEvents();
        } catch (\Throwable $th) {
            $this->handleExceptionCart($th);

            return 'error';
        }
    }

    protected function handleAddVoucher(Voucher $voucher, callable $callback)
    {
        $cart           =   $this->cart();
        $voucherValue   =   $voucher->value;
        $productIds     =   $voucher->products_id;

        $afterProcess   =   function () use ($callback, $voucher) {
            session()->put($this->voucherSessionKey, $voucher->code);

            $this->flashMessage(Message::ADD_VOUCHER_SUCCESS);

            $this->emitEvents();

            $callback();
        };

        if (in_array('all', $productIds)) {
            $cart->setGlobalDiscount($voucherValue);
        } else {
            $rowIds     =   $cart
                ->search(fn ($cartItem) => in_array($cartItem->id, $productIds))
                ->pluck('rowId');

            if (!$rowIds->count()) {
                return $this->flashMessage(Message::VOUCHER_NOT_CONTAIN_PRODUCT, 'error');
            }

            foreach ($rowIds as $rowId) $cart->setDiscount($rowId, $voucherValue);
        }

        $afterProcess();
    }

    protected function handleRemoveVoucher()
    {
        session()->forget($this->voucherSessionKey);

        $this->cart()->setGlobalDiscount(0);

        $this->flashMessage(Message::REMOVE_VOUCHER_SUCCESS, 'warning');

        $this->emitEvents();
    }

    /**
     * Events will emit after successful processing
     */
    private function emitEvents()
    {
        $this->emitTo('partials.quick-view-cart-component', 'cart-changed');
        $this->emitTo('partials.count-cart-component', 'cart-changed');
        $this->emitTo('cart-component', 'cart-changed');
        $this->emitTo('checkout-component', 'cart-changed');
    }

    /**
     * define instance of cart
     */
    protected function cart()
    {
        return Cart::instance($this->instance);
    }

    private function handleExceptionCart(\Throwable $e)
    {
        switch ($e) {
            case $e instanceof InvalidRowIDException:
                return $this->flashMessage(Message::INVALID_CART_EX, 'error');

            case $e instanceof InvalidArgumentException:
                return $this->flashMessage($e->getMessage(), 'error');

            default:
                throw $e;
        }
    }

    public function redirectToEmptyCart()
    {
        return redirect()->route('empty_cart');
    }
}
