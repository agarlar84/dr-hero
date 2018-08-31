<?php

namespace DrHero\Services;

use DrHero\Doctor\Doctor;

class DoctorReviewsService
{
    private $doctorReviews;

    /**
     * DoctorReviewsService constructor.
     * @param DoctorReviews $doctorReviews
     */
    public function __construct(DoctorReviews $doctorReviews)
    {
        $this->doctorReviews = $doctorReviews;
    }

    /**
     *
     *
     * BusinessRules
     *
     * If DrHero has ZERO reviews, ONLY show Public Health reviews
     * If DrHero has THREE OR LESS reviews AND Public Health has reviews, SHOW both
     * If DrHero has MORE THAN THREE ONLY show DrHero reviews
     *
     * DrHero review grater than 0 all of this:
     * If doctor rating is LESS than 6, rating tag has to be poor.
     * If doctor rating is BETWEEN than 6 and 8, rating tag has to be regular.
     * If doctor rating is grater than 8, rating tag has to be awesome.
     * If there any reviews, rating tag is always regular.
     *
     *
     *
     * @param Doctor $doctor
     * @return ReviewsResultDTO
     */
    public function __invoke(Doctor $doctor): ReviewsResultDTO
    {
        $resultDTO = new ReviewsResultDTO();

        if ($this->doctorReviews->countDrHeroReviews() === 0) {
            $resultDTO->setShowPublicHealthReviews(true);
            $resultDTO->showHeroReviews = false;

            return $resultDTO;
        } elseif ($this->doctorReviews->countPublicReviews() > 0) {
            if ($this->doctorReviews->countDrHeroReviews() <= 3
                && $this->doctorReviews->countDrHeroReviews() >= 1) {
                $resultDTO->setShowPublicHealthReviews(true);
                $resultDTO->showHeroReviews = true;

                if ($doctor->rating() < 6) {
                    $resultDTO->rating = 'poor';
                }

                return $resultDTO;
            }
        }
        if ($this->doctorReviews->countDrHeroReviews() > 0) {
            $resultDTO->setShowPublicHealthReviews(false);
            $resultDTO->showHeroReviews = true;

            if ($doctor->rating() < 6) {
                $resultDTO->rating = 'poor';
            }

            return $resultDTO;
        }

        /*if ($this->doctorReviews->countPublicReviews() == 0) {
            $resultDTO->setShowPublicHealthReviews(false);
        } elseif ($this->doctorReviews->countDrHeroReviews() > 0) {
            $resultDTO->showHeroReviews = true;

            if ($doctor->rating() < 0) {
                $resultDTO->rating = 'poor';
            } elseif ($doctor->rating() < 6) {
                $resultDTO->rating = 'regular';
            } else {
                $resultDTO->rating = 'super awesome';
            }
        }*/

        return $resultDTO;
    }
}
