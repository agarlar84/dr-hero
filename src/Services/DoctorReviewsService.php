<?php

namespace DrHero\Services;

use DrHero\Doctor\Doctor;

class DoctorReviewsService
{
    /**
     *
     *
     * BusinessRules
     *
     * Si DoctorHero tiene reviews se deben mostrar las HeroReviews
     *
     *
     *
     *
     *
     *
     *
     *
     *
     * @param Doctor $dr
     * @return ReviewsResultDTO
     */
    public function __invoke(Doctor $dr): ReviewsResultDTO
    {
        $resultDTO = new ReviewsResultDTO();

        $drv = new DrEvilReviews;
        $drh = new DrHeroReviews;

        if ($drv->reviews()->count() == 0) {
            $resultDTO->showEvilReviews = false;
        } elseif ($drh->amount > 0) {
            $resultDTO->showHeroReviews = true;

            if ($dr->rating() < 0) {
                $resultDTO->rating = 'poor';
            } elseif ($dr->rating() < 6) {
                $resultDTO->rating = 'regular';
            } else {
                $resultDTO->rating = 'awesome';
            }
        }

        return $resultDTO;
    }
}
