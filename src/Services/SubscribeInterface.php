<?php
/**
 * Created by PhpStorm.
 * User: alexgarcia
 * Date: 30/11/18
 * Time: 13:26
 */

namespace DrHero\Services;


interface SubscribeInterface
{
    public function addSubscriber($doctor);
}