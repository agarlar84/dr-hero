<?php

namespace DrHero\Services;

class ReviewsResultDTO
{
    public $showEvilReviews = true;
    public $showHeroReviews = false;
    public $rating;

    private $showPublicHealthReviews;

    /**
     * @param mixed $showPublicHealthReviews
     */
    public function setShowPublicHealthReviews($showPublicHealthReviews): void
    {
        $this->showPublicHealthReviews = $showPublicHealthReviews;
        $this->showEvilReviews = $showPublicHealthReviews;
    }

    /**
     * @return mixed
     */
    public function getShowPublicHealthReviews()
    {
        return $this->showPublicHealthReviews;
    }
}
