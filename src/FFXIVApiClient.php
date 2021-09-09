<?php

namespace App;

use XIVAPI\XIVAPI;

class FFXIVApiClient
{
    /**
     * @var string
     */
    private $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getClient(): XIVAPI
    {
        $api = new XIVAPI();
        $api->environment->key($this->key);

        return $api;
    }
}
