<?php

namespace App;

use XIVAPI\XIVAPI;

class FFXIVApiClient
{
    public function __construct(private string $key)
    {}

    public function getClient(): XIVAPI
    {
        $api = new XIVAPI();
        $api->environment->key($this->key);

        return $api;
    }
}
