<?php

namespace DrHero\Services;

use DrHero\Doctor\Collection;
use DrHero\Doctor\Review;

class DrEvilReviews
{
    public function reviews(): Collection
    {
        $review1 = new Review();
        $review1->value = 1;

        $review2 = new Review();
        $review1->value = 1;

        return new Collection($review1, $review2);
    }
}