<?php

namespace App\Services\GHN;

use App\Models\Order;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GHNBaseService
{
    protected $client;
    protected $response;
    protected $shopId;
    protected Order $order;
    protected string $token;
    protected int $serviceId;
    // 1: Bay, 2: Đi bộ, 3: Cồng kềnh (hiện tại không dùng, dùng serviceId)
    protected ?int $serviceTypeId = null;
    protected string $url = 'https://dev-online-gateway.ghn.vn/shiip/public-api';
    protected string $requiredNote = 'KHONGCHOXEMHANG';
    protected array $package = [
        'height' => null,
        'length' => null,
        'width' => null,
        'weight' => null,
    ];
    protected array $delivery = [
        'from' => null,
        'to' => null,
    ];

    public function __construct(int $shopId = 80614)
    {
        $this->token    =   config('settings.delivery_ghn_secret');
        $this->shopId   =   $shopId;
        $this->client   =   Http::withHeaders([
            'token'     =>  $this->token,
            'shop_id'   =>  $this->shopId,
        ]);
    }

    /**
     *  use (new LocationService($shopId))
     *  ->from(...)
     *  ->to(...)
     *  ->getServices()
     * @return Collection
     */
    public function getServices(): Collection
    {
        $this->response = $this->client->get("{$this->url}/v2/shipping-order/available-services", [
            'from_district' =>  $this->delivery['from']['district_id'],
            'to_district'   =>  $this->delivery['to']['district_id'],
            'shop_id'       =>  $this->shopId,
        ]);
        return $this->handleResponse();
    }

    /**
     * @return $this
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return $this
     */
    public function setServiceId(int $id)
    {
        $this->serviceId = $id;
        return $this;
    }

    /**
     * weight: gram, height, length, width: cm
     * @return $this
     */
    public function setPackage(int $height, int $length, int $width, int $weight)
    {
        $this->package['height']    =   $height;
        $this->package['length']    =   $length;
        $this->package['width']     =   $width;
        $this->package['weight']    =   $weight;
        return $this;
    }

    /**
     * @return $this
     */
    public function from(int $fromDistrict, string $fromWardCode)
    {
        $this->delivery['from']['district_id']  =   $fromDistrict;
        $this->delivery['from']['ward_code']    =   $fromWardCode;
        return $this;
    }

    /**
     * @return $this
     */
    public function to(int $toDistrict, string $toWardCode)
    {
        $this->delivery['to']['district_id']    =   $toDistrict;
        $this->delivery['to']['ward_code']      =   $toWardCode;
        return $this;
    }

    /**
     * @return $this
     */
    public function setDeliveryInfo(
        string $toName,
        string $toPhone,
        string $toAddress,
        string $fromName = "skinest",
        string $fromPhone = "0973366072",
        string $fromAddress = "75b đường số 2",
    ) {
        $this->delivery['from']['name']     =   $fromName;
        $this->delivery['from']['phone']    =   $fromPhone;
        $this->delivery['from']['address']  =   $fromAddress;
        $this->delivery['to']['name']       =   $toName;
        $this->delivery['to']['phone']      =   $toPhone;
        $this->delivery['to']['address']    =   $toAddress;
        return $this;
    }

    /**
     * @return Collection
     */
    protected function handleResponse(): Collection
    {
        if ($this->response->failed()) {
            $res = $this->response->object();
            throw new Exception($res->message, $res->code);
        }
        return collect($this->response->json()['data']);
    }
}
