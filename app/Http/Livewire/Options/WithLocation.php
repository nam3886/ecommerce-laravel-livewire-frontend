<?php

namespace App\Http\Livewire\Options;

use App\Services\GHN\GHNLocationService;
use Illuminate\Support\Collection;

// get districts, wards and format select2
trait WithLocation
{
    public Collection $provinces;
    public Collection $districts;
    public Collection $wards;

    public function getDistricts()
    {
        $location = new GHNLocationService();
        try {
            $provinces = cache()->rememberForever('ghn_provinces', fn () => $location->getProvinces());
            $districts = cache()->rememberForever('ghn_districts', fn () => $location->getDistricts());
        } catch (\Throwable $th) {
            return $this->flashErrorMessage($th->getMessage());
        }

        $this->districts = $districts->map(function ($item) use ($provinces) {
            $text = $provinces->where('ProvinceID', $item['ProvinceID'])->first();
            $text = $text['ProvinceName'] ?? 'undefined';
            return [
                'id' => $item['DistrictID'],
                'text' => $item['DistrictName'] . ' - ' . $text,
                'disabled' => $item['SupportType'] !== 3,
                'selected' => $this->user->get('district') == $item['DistrictID'],
            ];
        });
    }

    public function getWards()
    {
        $districtId = $this->user->get('district');
        $location = new GHNLocationService();
        $cacheKey = "ghn_wards_{$districtId}";
        try {
            $wards = cache()->rememberForever($cacheKey, fn () => $location->getWards($districtId));
        } catch (\Throwable $th) {
            return $this->flashErrorMessage($th->getMessage());
        }

        $this->wards = $wards->map(fn ($item) => [
            'id' => $item['WardCode'],
            'text' => $item['WardName'],
            'selected' => $this->user->get('ward') == $item['WardCode'],
        ]);
    }
}
