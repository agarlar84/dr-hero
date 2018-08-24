<?php

namespace DrHero\Services;

use DrHero\Doctor\Collection;
use DrHero\Doctor\Doctor;
use DrHero\Doctor\Review;

class DrEvilReviews
{
    public function reviews(Doctor $doctor): Collection
    {
        $cli = AwesomeClient::create($doctor);

        $data = [];
        foreach ($cli->reviews as $number) {
            $review = new Review();
            $review->value = $number;
            $data[] = $review;
        }

        return new Collection(...$data);
    }
}

class AwesomeClient {
    public static function create($doctor)
    {
        $cli = new \StdClass();
        $cli->reviews = [1,4,5,6];

        return $cli;
    }
}