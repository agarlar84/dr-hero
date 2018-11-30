<?php
/**
 * Created by PhpStorm.
 * User: alexgarcia
 * Date: 30/11/18
 * Time: 13:27
 */

namespace DrHero\Services;
use DrHero\Services\MailService\TweeterSubscriber;

class SubscriberTweeterAdapter implements SubscribeInterface
{
    private $subscriber;

    public function __construct(
        TweeterSubscriber $subscriber
    ) {
        $this->subscriber = $subscriber;
    }

    public function addSubscriber($doctor)
    {
        $this->subscriber->addSubscriptionToUser($doctor->name,$doctor->accountTweeter);
    }
}