<?php

namespace App\Helpers;

use App\Models\Order;
use Carbon\Carbon;
use Swap\Laravel\Facades\Swap;

/**
 * hàm exchangeRate sẽ quyết định return int hay float
 */
class Currency
{
    private static $defaultCurrency = 'VND';
    private static $defaultLocale = 'vi_VN';
    private static $currencyAvailable = ['USD', 'VND'];

    private static function checkValid(string $from, string $to): void
    {
        abort_if(!in_array($from, self::$currencyAvailable) || !in_array($to, self::$currencyAvailable), 500);
    }

    public static function getDefaultCurrency(): string
    {
        return static::$defaultCurrency;
    }

    public static function getDefaultLocale(): string
    {
        return static::$defaultLocale;
    }

    public static function getUserLocale(): string
    {
        // return session()->get('user.actions.locale', 'en_US');
        return session()->get('user.actions.locale', self::getDefaultLocale());
    }

    public static function getUserCurrency(): string
    {
        // return session()->get('user.actions.currency', 'USD');
        return session()->get('user.actions.currency', self::getDefaultCurrency());
    }

    public static function getLatestSwap(string $from, string $to)
    {
        // VND không thể chuyển ngược qua các loại khác
        $localeExchange = $from === 'VND' ? "$to/$from" : "$from/$to";
        return Swap::latest($localeExchange);
    }

    public static function getSymbol(): string
    {
        $locale = self::getUserLocale();
        $symbol = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        return $symbol->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }

    public static function getHistoryRate(int|Carbon $time, string $from, string $to)
    {
        $localeExchange = $from === 'VND' ? "$to/$from" : "$from/$to";
        is_int($time) && $time = Carbon::createFromTimestamp($time);
        $rate = Swap::historical($localeExchange, $time)->getValue();
        return $from === 'VND' ? 1 / $rate : $rate;
    }

    public static function ceilThousand($digits): int
    {
        return ceil($digits / 1E3) * 1E3;
    }

    public static function getRate(string $from, string $to)
    {
        // VND không thể chuyển ngược qua các loại khác
        $rate = self::getLatestSwap($from, $to)->getValue();
        return $from === 'VND' ? 1 / $rate : $rate;
    }

    public static function exchangeRate($digits, string $from, string $to)
    {
        self::checkValid($from, $to);
        // from === to => don't need exchange
        $from !== $to && $digits *= self::getRate($from, $to);
        // làm tròn phần trăm
        $to === 'VND' && $digits = self::ceilThousand($digits);
        // return ceil($digits);
        return $digits;
    }

    public static function autoFormatCurrency($digits): string
    {
        $to = self::getUserCurrency();
        $digits = self::exchangeRate($digits, self::getDefaultCurrency(), $to);
        $digits = round($digits, 2);
        // nhân với 100 theo thư viện money, VND không cần nhân
        $to !== 'VND' && $digits *= 100;
        return money($digits, $to)->format();
    }

    public static function autoFormatOrderCurrency($digits, Order $order): string
    {
        $to = $order->exchange_currency->to;
        $rate = $order->exchange_rate;
        $digits *= $rate;
        $to === 'VND' && $digits = self::ceilThousand($digits);
        $digits = round($digits, 2);
        // nhân với 100 theo thư viện money, VND không cần nhân
        $to !== 'VND' && $digits *= 100;
        return money($digits, $to)->format();
    }
}
