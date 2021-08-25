<?php

namespace App\Services\GHN;

use App\Services\GHN\GHNBaseService;
use Illuminate\Support\Collection;

class GHNStoreService extends GHNBaseService
{
    public function getStores(): Collection
    {
        $this->response = $this->client->get("{$this->url}/v2/shop/all");
        return $this->handleResponse();
    }

    public function createStore(): Collection
    {
        $this->response = $this->client->post("{$this->url}/v2/shop/register", [
            'name'          =>  $this->delivery['from']['name'],
            'phone'         =>  $this->delivery['from']['phone'],
            'address'       =>  $this->delivery['from']['address'],
            'ward_code'     =>  $this->delivery['from']['ward_code'],
            'district_id'   =>  $this->delivery['from']['district_id'],
        ]);

        return $this->handleResponse();
    }
}
