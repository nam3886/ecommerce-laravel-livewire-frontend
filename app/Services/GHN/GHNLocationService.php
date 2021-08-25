<?php

namespace App\Services\GHN;

use App\Services\GHN\GHNBaseService;
use Illuminate\Support\Collection;

class GHNLocationService extends GHNBaseService
{
    public function getProvinces(): Collection
    {
        $this->response = $this->client->get("{$this->url}/master-data/province");
        return $this->handleResponse();
    }

    public function getDistricts(): Collection
    {
        $this->response = $this->client->get("{$this->url}/master-data/district");
        return $this->handleResponse();
    }

    public function getWards(int $districtId): Collection
    {
        $this->response = $this->client->get("{$this->url}/master-data/ward", [
            'district_id' => $districtId
        ]);
        return $this->handleResponse();
    }

    /**
     *  use (new LocationService($shopId))
     *  ->setServiceId(...)
     *  ->setPackage(...)
     *  ->from(...)
     *  ->to(...)
     *  ->calculateFee()
     *  @return Collection
     */
    public function calculateFee(int $price, string $coupon = null): Collection
    {
        $this->response = $this->client->post("{$this->url}/v2/shipping-order/fee", [
            "coupon"            =>  $coupon,
            "insurance_value"   =>  $price,
            "service_id"        =>  $this->serviceId,
            // "service_type_id"   =>  $this->serviceTypeId,
            "from_district_id"  =>  $this->delivery['from']['district_id'],
            "to_district_id"    =>  $this->delivery['to']['district_id'],
            "to_ward_code"      =>  $this->delivery['to']['ward_code'],
            "height"            =>  $this->package['height'],
            "length"            =>  $this->package['length'],
            "width"             =>  $this->package['width'],
            "weight"            =>  $this->package['weight'],
        ]);
        return $this->handleResponse();
    }

    /**
     *  use (new LocationService($shopId))
     *  ->setServiceId(...)
     *  ->from(...)
     *  ->to(...)
     *  ->calculateDeliveryTime()
     * @return Collection
     */
    public function calculateDeliveryTime(): Collection
    {
        $this->response = $this->client->post("{$this->url}/v2/shipping-order/leadtime", [
            "service_id"        =>  $this->serviceId,
            // "service_type_id"   =>  $this->serviceTypeId,
            "from_district_id"  =>  $this->delivery['from']['district_id'],
            "from_ward_code"    =>  $this->delivery['from']['ward_code'],
            "to_district_id"    =>  $this->delivery['to']['district_id'],
            "to_ward_code"      =>  $this->delivery['to']['ward_code'],
        ]);
        return $this->handleResponse();
    }
}
