<?php

namespace App\Facades;

use App\Services\CurrenciesService;
use Illuminate\Support\Facades\Facade;

class Currencies extends Facade
{
  protected static function getFacadeAccessor(): string
  {
    return CurrenciesService::class;
  }
}
