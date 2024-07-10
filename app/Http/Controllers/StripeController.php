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

    public function authenticate(Request $request)
    {
        dd($request);
        if(!$request->has([]))
        {
            return new Exception("Fields missing, fill them and try again.");
        }

        $this->StripeService->authenticate();
    }
}