<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function update(Request $request)
    {
        $currency = $request->currency;

        dd($currency);
    }
}
