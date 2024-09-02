<?php

namespace App\Services;

use App\Models\Currency;

class CurrenciesService
{
    private $currencies;
    private $activeCurrency;

    public function __construct()
    {
        // Initialize the properties inside the constructor
        $this->currencies = Currency::all();
        $this->activeCurrency = $this->currencies->firstWhere('is_active', 1);
    }

    public function setActiveCurrency(Currency $currency): void
    {
        Currency::query()->update(['is_active' => 0]);

        $currency->update(['is_active' => 1]);

        $this->activeCurrency = $currency;
    }

    public function getActiveCurrency(): Currency
    {
        return $this->activeCurrency;
    }

    public function getCurrencies()
    {
        return $this->currencies;
    }
}
