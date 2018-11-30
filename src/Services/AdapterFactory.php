<?php
/**
 * Created by PhpStorm.
 * User: alexgarcia
 * Date: 30/11/18
 * Time: 13:28
 */

namespace DrHero\Services;


use DrHero\Doctor\Doctor;

class AdapterFactory
{
    public function buildAdapter(Doctor $doctor)
    {
        if ($doctor->isTweeter) {
            return new SubscriberTweeterAdapter();
        }

        return new SubscriberMCAdapter();
    }
}