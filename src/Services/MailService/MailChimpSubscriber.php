<?php

namespace DrHero\Services\MailService;

class MailChimpSubscriber
{
    private $mailChimpCli;

    public function __construct($mailChimpCli)
    {
        $this->mailChimpCli = $mailChimpCli;
    }

    public function subscribeUserToMCh($username)
    {
        $connection = $this->mailChimpCli->connect();
        $connection->subscribe($username);
    }
}
