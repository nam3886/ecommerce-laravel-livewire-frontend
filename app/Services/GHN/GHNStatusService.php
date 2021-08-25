<?php

namespace App\Services\GHN;

class GHNStatusService
{
    public static function getMessage(string $status): string
    {
        $list = [
            'ready_to_pick' => 'Shipping order has just been created',
            'picking' => 'Shipper is coming to pick up the goods',
            'cancel' => 'Shipping order has been cancelled',
            'money_collect_picking' => 'Shipper are interacting with the seller',
            'picked' => 'Shipper is picked the goods',
            'storing' => 'The goods has been shipped to GHN sorting hub',
            'transporting' => 'The goods are being rotated',
            'sorting' => 'The goods are being classified (at the warehouse classification)',
            'delivering' => 'Shipper is delivering the goods to customer',
            'money_collect_delivering' => 'Shipper is interacting with the buyer',
            'delivered' => 'The goods has been delivered to customer',
            'delivery_fail' => 'The goods hasn\'t been delivered to customer',
            'waiting_to_return' => 'The goods are pending delivery (can be delivered within 24/48h)',
            'return' => 'The goods are waiting to return to seller/merchant after 3 times delivery failed',
            'return_transporting' => 'The goods are being rotated',
            'return_sorting' => 'The goods are being classified (at the warehouse classification)',
            'returning' => 'The shipper is returning for seller',
            'return_fail' => 'The returning is failed',
            'returned' => 'The goods has been returned to seller/merchant',
            'damage' => 'Damaged goods',
            'lost' => 'The goods are lost',
            'exception' => 'The goods exception handling (cases that go against the process).
For example:
- The order has been taken but the reseller has requested it
- The order has been delivered but the buyer wants to return it',
        ];
        return isset($list[$status]) ? $list[$status] : 'Can\'t get message!';
    }
}
