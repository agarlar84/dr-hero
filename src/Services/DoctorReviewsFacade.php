<?php

namespace DrHero\Services;

use DrHero\Doctor\Doctor;

class DoctorReviewsFacade implements DoctorReviews
{
    private $doctor;

    private $drHeroReviews;

    private $publicHealthReviews;

    /**
     * DoctorReviewsFacade constructor.
     *
     * @param Doctor $doctor
     * @param DrHeroReviews $drHeroReviews
     * @param PublicHealthReviews $publicHealthReviews
     */
    public function __construct(Doctor $doctor, DrHeroReviews $drHeroReviews, PublicHealthReviews $publicHealthReviews)
    {
        $this->doctor = $doctor;
        $this->drHeroReviews = $drHeroReviews;
        $this->publicHealthReviews = $publicHealthReviews;
    }

    public function countPublicReviews(): int
    {
        return $this->publicHealthReviews->reviews($this->doctor)->count();
    }

    public function countDrHeroReviews(): int
    {
        return $this->drHeroReviews->amount;
    }
}