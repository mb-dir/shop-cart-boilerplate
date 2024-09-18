<?php

namespace App\Services;


use App\Models\Affiliate;
use App\Models\User;


class AffiliateService
{
    /**
     * Create a new class instance.
     */
    private string $baseUrl;


    public function __construct($baseUrl = 'https://shop-cart-boilerplate.test/register?aff-ref=')
    {
        $this->baseUrl = $baseUrl;
    }


    public function createAffiliate(User $user)
    {
        $affiliate = new Affiliate();
        $affiliate->user_id = $user->id;
        $affiliate->link = $this->createAffiliateLink($user->id);

        $affiliate->save();

        return $affiliate->link;
    }


    private function createAffiliateLink(mixed $userId): string
    {
        return $this->baseUrl . $userId;
    }
}
