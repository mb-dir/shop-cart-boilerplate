<?php

namespace App\Http\Controllers;

use App\Facades\Currencies;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function update(Request $request)
    {
        $currency = Currency::findOrFail($request->currency);

        Currencies::setActiveCurrency($currency);

        return redirect()->back()->with('message', 'Currency updated!');
    }
}
