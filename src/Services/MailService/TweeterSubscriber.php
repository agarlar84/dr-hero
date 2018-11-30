<?php

namespace DrHero\Services\MailService;

class TweeterSubscriber
{
    private $tweeterCli;

    public function __construct($tweeterCli)
    {
        $this->tweeterCli = $tweeterCli;
    }

    public function addSubscriptionToUser($username, $account)
    {
        $usr = $this->tweeterCli->retrieveUser($username);
        $usr->attach($account);
    }
}