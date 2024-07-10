<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class StripeService
{
    private String $apiKey;
    private String $secret;
    private String $baseUri;

    public function __construct()
    {
        $this->apiKey = config("services.stripe.key");
        $this->secret = config("services.stripe.secret");
        $this->baseUri = config("services.stripe.base_uri");
    }

    private function GuzzleClient()
    {
        return new Client(['base_uri' => $this->baseUri]);
    }

    public function authenticate()
    {
        try
        {
            return $this->GuzzleClient()->request(
                "POST",
                "/v1/charges",
                [
                    'headers' => [
                        'Authorization' => "Bearer ".$this->apiKey,
                    ]
                ]
            );
        }
        catch(\Throwable $throw)
        {
            return new Exception($throw->getMessage());
        }
    }
}