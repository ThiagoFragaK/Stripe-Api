<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class StripeService
{
    private String $apiKey;
    private String $secret;
    private String $baseUri;
    private Array $Headers;

    public function __construct()
    {
        $this->apiKey = config("services.stripe.key");
        $this->secret = config("services.stripe.secret");
        $this->baseUri = config("services.stripe.base_uri");

        $this->Headers = [
            'Authorization' => "Bearer ".$this->secret,
            'Content-Type' => "application/x-www-form-urlencoded",
        ];
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
                    'headers' => $this->Headers
                ]
            );
        }
        catch(\Throwable $throw)
        {
            return new Exception($throw->getMessage());
        }
    }

    public function getBalance()
    {
        try
        {
            return $this->GuzzleClient()->request(
                "GET",
                "/v1/balance",
                [
                    'headers' => $this->Headers,
                    'form_params' => []
                ]
            )->getBody()->getContents();
        }
        catch(\Throwable $e)
        {
            return new Exception($e->getMessage());
        }
    }
}