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
     * If DrHero has ZERO reviews, ONLY show Public Health reviews
     * If DrHero has THREE OR LESS reviews AND Public Health has reviews, SHOW both
     * If DrHero has MORE THAN THREE ONLY show DrHero reviews
     * If doctor rating is LESS than 6, rating tag has to be poor.
     * If doctor rating is BETWEEN than 6 and 8, rating tag has to be regular.
     * If doctor rating is grater than 8, rating tag has to be awesome.
     * If there any reviews, rating tag is always regular.
     *
     *
     *
     * @param Doctor $dr
     * @return ReviewsResultDTO
     */
    public function __invoke(Doctor $dr): ReviewsResultDTO
    {
        $resultDTO = new ReviewsResultDTO();

        $publicReviews = new PublicHealthReviews;
        $drh = new DrHeroReviews;

        if ($publicReviews->reviews($dr)->count() == 0) {
            $resultDTO->showEvilReviews = false;
        } elseif ($drh->amount > 0) {
            $resultDTO->showHeroReviews = true;

            if ($dr->rating() < 0) {
                $resultDTO->rating = 'poor';
            } elseif ($dr->rating() < 6) {
                $resultDTO->rating = 'regular';
            } else {
                $resultDTO->rating = 'super awesome';
            }
        }

        return $resultDTO;
    }
}
