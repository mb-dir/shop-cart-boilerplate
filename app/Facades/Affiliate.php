<?php

namespace App\Facades;


use App\Services\AffiliateService;
use Illuminate\Support\Facades\Facade;


class Affiliate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AffiliateService::class;
    }
}