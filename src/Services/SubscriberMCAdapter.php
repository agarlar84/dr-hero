<?php
/**
 * Created by PhpStorm.
 * User: alexgarcia
 * Date: 30/11/18
 * Time: 13:18
 */

namespace DrHero\Services;
use DrHero\Services\MailService\MailChimpSubscriber;

class SubscriberMCAdapter implements SubscribeInterface
{
    private $chimpSubscriber;

    public function __construct(
        MailChimpSubscriber $chimpSubscriber
    ) {
        $this->chimpSubscriber = $chimpSubscriber;
    }

    public function addSubscriber($doctor)
    {
        $this->chimpSubscriber->subscribeUserToMCh($doctor->name);
    }
}