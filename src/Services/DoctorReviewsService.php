<?php

namespace DrHero\Services;

use DrHero\Doctor\Doctor;

class DoctorReviewsService
{
    public function __invoke(Doctor $dr): ReviewsResultDTO
    {
        $resultDTO = new ReviewsResultDTO();

        $drv = new DrEvilReviews;
        $drh = new DrHeroReviews;

        if ($drv->reviews()->count() == 0) {
            $resultDTO->showEvilReviews = false;
        } elseif ($drh->amount > 0) {
            $resultDTO->showHeroReviews = true;
        }



        return $resultDTO;
    }
}
