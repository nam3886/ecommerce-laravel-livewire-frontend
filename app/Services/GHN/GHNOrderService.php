<?php

namespace App\Services\GHN;

use App\Services\GHN\GHNBaseService;
use Illuminate\Support\Collection;

class GHNOrderService extends GHNBaseService
{
    /**
     *  use (new OrderService($shopId))
     *  ->setDeliveryInfo(...)
     *  ->setServiceId(...)
     *  ->setPackage(...)
     *  ->setOrder(...)
     *  ->from(...)
     *  ->to(...)
     *  ->previewOrder()
     * @return Collection
     */
    public function previewOrder(): Collection
    {
        $this->response = $this->client->post("{$this->url}/v2/shipping-order/preview", [
            "to_name"               =>  $this->delivery['to']['name'],
            "to_phone"              =>  $this->delivery['to']['phone'],
            "to_address"            =>  $this->delivery['to']['address'],
            "to_ward_code"          =>  $this->delivery['to']['ward_code'],
            "to_district_id"        =>  $this->delivery['to']['district_id'],
            "return_phone"          =>  $this->delivery['from']['phone'],
            "return_address"        =>  $this->delivery['from']['address'],
            "return_ward_code"      =>  $this->delivery['from']['ward_code'],
            "return_district_id"    =>  $this->delivery['from']['district_id'],
            "length"                =>  $this->package['length'],
            "width"                 =>  $this->package['width'],
            "height"                =>  $this->package['height'],
            "weight"                =>  $this->package['weight'],
            "required_note"         =>  $this->requiredNote,
            // "service_type_id"       =>  $this->serviceTypeId,
            "service_id"            =>  $this->serviceId,
            "payment_type_id"       =>  1,

            "client_order_code"     =>  $this->order->order_code,
            "insurance_value"       =>  $this->order->order_total,
            "cod_amount"            =>  $this->order->cod_amount, // tiền thu hộ
            "coupon"                =>  null,
            "pick_station_id"       =>  null,
            "pick_shift"            =>  [2],

            "note"                  =>  $this->order->note,
            "content"               =>  "Theo New York Times",
            "items"                 =>  $this->calculateItems(),
        ]);

        return $this->handleResponse();
    }

    /**
     *  use (new OrderService($shopId))
     *  ->setDeliveryInfo(...)
     *  ->setServiceId(...)
     *  ->setPackage(...)
     *  ->setOrder(...)
     *  ->from(...)
     *  ->to(...)
     *  ->previewOrder()
     * @return Collection
     */
    public function createOrder(): Collection
    {
        $this->response = $this->client->post("{$this->url}/v2/shipping-order/create", [
            "to_name"               =>  $this->delivery['to']['name'],
            "to_phone"              =>  $this->delivery['to']['phone'],
            "to_address"            =>  $this->delivery['to']['address'],
            "to_ward_code"          =>  $this->delivery['to']['ward_code'],
            "to_district_id"        =>  $this->delivery['to']['district_id'],
            "return_phone"          =>  $this->delivery['from']['phone'],
            "return_address"        =>  $this->delivery['from']['address'],
            "return_ward_code"      =>  $this->delivery['from']['ward_code'],
            "return_district_id"    =>  $this->delivery['from']['district_id'],
            "length"                =>  $this->package['length'],
            "width"                 =>  $this->package['width'],
            "height"                =>  $this->package['height'],
            "weight"                =>  $this->package['weight'],
            "required_note"         =>  $this->requiredNote,
            // "service_type_id"       =>  $this->serviceTypeId,
            "service_id"            =>  $this->serviceId,
            "payment_type_id"       =>  1,

            "client_order_code"     =>  $this->order->order_code,
            "insurance_value"       =>  $this->order->order_total,
            "cod_amount"            =>  $this->order->cod_amount, // tiền thu hộ
            "coupon"                =>  null,
            "pick_station_id"       =>  null,
            "pick_shift"            =>  [2],

            "note"                  =>  $this->order->note,
            "content"               =>  "Theo New York Times",
            "items"                 =>  $this->calculateItems(),
        ]);

        return $this->handleResponse();
    }

    public function getOrderDetail(string $orderCode): Collection
    {
        $this->response = $this->client->post("{$this->url}/v2/shipping-order/detail", [
            'order_code' => $orderCode
        ]);

        return $this->handleResponse();
    }

    public function destroyOrder(...$orderCodes): Collection
    {
        $this->response = $this->client->post("{$this->url}/v2/switch-status/cancel", [
            'order_codes' => $orderCodes
        ]);

        return $this->handleResponse();
    }

    public function printOrder(...$orderCodes)
    {
        $this->response = $this->client->post("{$this->url}/v2/a5/gen-token", [
            'order_codes' => $orderCodes
        ]);

        $token = $this->handleResponse()->get('data')->token;

        return redirect("https://dev-online-gateway.ghn.vn/a5/public-api/printA5?token={$token}");
    }

    private function calculateItems(): array
    {
        $items = [];
        foreach ($this->order->items as $item) {
            $items[] = [
                "name"          =>  $item->name,
                "code"          =>  $item->pivot->sku,
                "quantity"      =>  $item->pivot->quantity,
                "price"         =>  $item->pivot->price,
                "length"        =>  $item->pivot->variant->length,
                "width"         =>  $item->pivot->variant->width,
                "height"        =>  $item->pivot->variant->height,
                "weight"        =>  $item->pivot->variant->weight,
                "category"      =>
                [
                    "level1"    =>  "Giày"
                ]
            ];
        }
        return $items;
    }
}
