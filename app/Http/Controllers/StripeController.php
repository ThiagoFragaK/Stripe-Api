<?php

namespace App\Http\Controllers;

use App\Services\StripeService;
use Exception;
use Illuminate\Support\Facades\Request;

class StripeController extends Controller
{
    private StripeService $StripeService;
    public function __construct()
    {
        $this->StripeService = new StripeService();
    }

    public function authenticate()
    {
        return $this->StripeService->authenticate();
    }

    public function getBalance()
    {
        return $this->StripeService->getBalance();
    }
}