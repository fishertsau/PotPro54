<?php


namespace Acme\Auth;


interface SocialiteGateway
{
    public function redirectToProvider($service);
    public function handleProviderCallback($user);

}