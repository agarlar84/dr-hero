<?php

namespace DrHero\Services;

interface DoctorReviews
{
    public function countPublicReviews(): int;

    public function countDrHeroReviews(): int;
}