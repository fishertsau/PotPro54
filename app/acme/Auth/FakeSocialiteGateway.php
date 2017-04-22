<?php


namespace Acme\Auth;


class FakeSocialiteGateway implements SocialiteGateway
{
    public function redirectToProvider($service)
    {
        return $service;
    }

    public function handleProviderCallback($user)
    {
        dump($user);
        return $this->deNormalizeJsonObject($user);
    }

    private function deNormalizeJsonObject($obj)
    {
        return \GuzzleHttp\json_decode($obj);
    }
}