<?php

namespace DrHero\Doctor;

class Doctor
{
    public $rating;
    public $isTweeter;
    public $accountTweeter;
    public $name;

    public function rating()
    {
        return $this->rating;
    }
}
