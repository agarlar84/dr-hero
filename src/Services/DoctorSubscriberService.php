<?php

namespace DrHero\Services;

use DrHero\Doctor\Doctor;
use DrHero\Services\MailService\MailChimpSubscriber;
use DrHero\Services\MailService\TweeterSubscriber;

class DoctorSubscriberService
{
    /** @var MailChimpSubscriber */
    private $chimpSubscriber;
    /** @var TweeterSubscriber */
    private $subscriber;

    public function __construct(
        MailChimpSubscriber $chimpSubscriber,
        TweeterSubscriber $subscriber
    ) {
        $this->chimpSubscriber = $chimpSubscriber;
        $this->subscriber = $subscriber;
    }

    public function subscribeDoctor(Doctor $doctor)
    {
        if ($doctor->isTweeter) {
            $this->subscriber->addSubscriptionToUser($doctor->name,$doctor->accountTweeter);
        } else {
            $this->chimpSubscriber->subscribeUserToMCh($doctor->name);
        }
    }
}