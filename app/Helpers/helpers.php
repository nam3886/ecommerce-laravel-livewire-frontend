<?php

if (!function_exists('get_site_image_link')) {
    function get_site_image_link(?string $configName): ?string
    {
        return collect(json_decode(config("settings.{$configName}"))?->link)->first();
    }
}
