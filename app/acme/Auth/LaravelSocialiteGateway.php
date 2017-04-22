<?php


namespace Acme\Auth;

use Socialite;

class LaravelSocialiteGateway implements SocialiteGateway
{
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($user)
    {
        return (Socialite::driver($user)->user());
    }
}