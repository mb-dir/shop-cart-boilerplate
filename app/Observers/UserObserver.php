<?php

namespace App\Observers;


use App\Facades\Affiliate;
use App\Mail\UserEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $affiliate = Affiliate::createAffiliate($user);
        dd($affiliate);
        Mail::to($user->email)->send(new UserEmail($user));
    }


    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }


    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }


    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }


    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }
}
