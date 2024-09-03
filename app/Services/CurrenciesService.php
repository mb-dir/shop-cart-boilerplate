<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class CurrenciesService
{
    private $currencies;
    private $activeCurrency;
    private $rates;

    public function __construct()
    {
        // Initialize the properties inside the constructor
        $this->currencies = Currency::all();
        $this->activeCurrency = $this->currencies->firstWhere('is_active', 1);
        $this->rates = [
            'PLN' => 1.0000,
            'EUR' => $this->fetchRate('eur'),
            'USD' => $this->fetchRate('usd'),
        ];
    }

    private function fetchRate(string $code)
    {
        return Http::nbp()->get("exchangerates/rates/a/{$code}/today/")->json()['rates'][0]['mid'];
    }

    public function setActiveCurrency(Currency $currency): void
    {
        Currency::query()->update(['is_active' => 0]);

        $currency->update(['is_active' => 1]);

        $this->activeCurrency = $currency;
    }

    public function getActiveCurrency(): Currency | null
    {
        return $this->activeCurrency;
    }

    public function getCurrencies()
    {
        return $this->currencies;
    }
}
