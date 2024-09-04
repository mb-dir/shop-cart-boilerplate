<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class CurrenciesService
{
    private $currencies;
    private $activeCurrency;
    private $prevActiveCurrency;
    private $rates;

    public function __construct()
    {
        $this->currencies = Currency::all();
        $this->activeCurrency = $this->currencies->firstWhere('is_active', 1);
        $this->prevActiveCurrency = $this->prevActiveCurrency;
        $this->rates = [
            'PLN' => 1.0000,
            'EUR' => $this->fetchRate('eur'),
            'USD' => $this->fetchRate('usd'),
        ];
    }

    private function fetchRate(string $code)
    {
        return Http::nbp()->get("exchangerates/rates/a/{$code}")->json()['rates'][0]['mid'];
    }

    public function setActiveCurrency(Currency $currency): void
    {
        $this->prevActiveCurrency = $this->activeCurrency;
        $this->activeCurrency = $currency;

        Currency::query()->update(['is_active' => 0]);
        $currency->update(['is_active' => 1]);

        $this->exchangePrices();
    }

    private function exchangePrices(): void
    {
        $prevRate = $this->rates[$this->prevActiveCurrency->code];
        $activeRate = $this->rates[$this->activeCurrency->code];

        $products = Product::all();

        foreach ($products as $product) {
            $priceInPLN = $product->price * $prevRate;   // Convert to PLN using previous rate
            $convertedPrice = $priceInPLN / $activeRate; // Convert from PLN to active currency

            $product->update(['price' => $convertedPrice]);
        }
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
