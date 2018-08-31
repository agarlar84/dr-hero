<?php

namespace Tests;

use DrHero\Doctor\Doctor;
use DrHero\Services\DoctorReviews;
use DrHero\Services\DoctorReviewsService;
use PHPUnit\Framework\TestCase;

class DoctorReviewsServiceTest extends TestCase
{
    /**
     * @test
     */
    public function givenADoctorWhenHasZeroReviewsThenOnlyShowPublicHealthReviews()
    {
        $doctor = new Doctor();

        $doctorReviews = $this->prophesize(DoctorReviews::class);
        $doctorReviews
            ->countDrHeroReviews()
            ->willReturn(0);

        $sut = new DoctorReviewsService($doctorReviews->reveal());
        $dto = $sut->__invoke($doctor);

        $this->assertTrue($dto->getShowPublicHealthReviews());
        $this->assertTrue($dto->showEvilReviews);
        $this->assertFalse($dto->showHeroReviews);
    }

    /**
     * @test
     */
    public function givenADoctorWhenHasThreeOrLessReviewsAndHasPublicReviewsThenShowBoth()
    {
        $doctor = new Doctor();

        $doctorReviews = $this->prophesize(DoctorReviews::class);
        $doctorReviews
            ->countDrHeroReviews()
            ->willReturn(3);
        $doctorReviews
            ->countPublicReviews()
            ->willReturn(1);

        $sut = new DoctorReviewsService($doctorReviews->reveal());
        $dto = $sut->__invoke($doctor);

        $this->assertTrue($dto->getShowPublicHealthReviews());
        $this->assertTrue($dto->showEvilReviews);
        $this->assertTrue($dto->showHeroReviews);
    }

    //     * If DrHero has MORE THAN THREE ONLY show DrHero reviews

    /**
     * @test
     */
    public function givenADoctorWhenHasMoreThanThreeReviewsThenOnlyShowDrHeroReviews()
    {
        $doctor = new Doctor();

        $doctorReviews = $this->prophesize(DoctorReviews::class);
        $doctorReviews
            ->countDrHeroReviews()
            ->willReturn(4);
        $doctorReviews
            ->countPublicReviews()
            ->willReturn(4);

        $sut = new DoctorReviewsService($doctorReviews->reveal());
        $dto = $sut->__invoke($doctor);

        $this->assertFalse($dto->getShowPublicHealthReviews());
        $this->assertTrue($dto->showHeroReviews);
    }

    /**
     * If doctor rating is LESS than 6, rating tag has to be poor.
     *
     * @test
     */
    public function givenADrHeroHasReviewsWhenARatingIsLessThan6ThenRatingTagIsPoor()
    {
        $doctor = new Doctor();
        $doctor->rating = 5;

        $doctorReviews = $this->prophesize(DoctorReviews::class);

        $doctorReviews
            ->countDrHeroReviews()
            ->willReturn(1);

        $doctorReviews
            ->countPublicReviews()
            ->willReturn(1);

        $sut = new DoctorReviewsService($doctorReviews->reveal());
        $dto = $sut->__invoke($doctor);

        $this->assertEquals("poor", $dto->rating);
        $this->assertTrue($dto->getShowPublicHealthReviews());
        $this->assertTrue($dto->showHeroReviews);
    }

    /**
     * @test
     */
    public function givenADrHeroHasReviewsWhenARatingIsLessThan6ThenRatingTagIsPoor2()
    {
        $doctor = new Doctor();
        $doctor->rating = 5;

        $doctorReviews = $this->prophesize(DoctorReviews::class);

        $doctorReviews
            ->countDrHeroReviews()
            ->willReturn(4);

        $doctorReviews
            ->countPublicReviews()
            ->willReturn(1);

        $sut = new DoctorReviewsService($doctorReviews->reveal());
        $dto = $sut->__invoke($doctor);

        $this->assertEquals("poor", $dto->rating);
        $this->assertFalse($dto->getShowPublicHealthReviews());
        $this->assertTrue($dto->showHeroReviews);
    }

    /**
     * @test
     */
    public function givenADrHeroHasReviewsWhenARatingIsLessThan6AndThereIsNoPublicReviewsThenShowDrHeroAndRatingPoor()
    {
        $doctor = new Doctor();
        $doctor->rating = 5;

        $doctorReviews = $this->prophesize(DoctorReviews::class);

        $doctorReviews
            ->countDrHeroReviews()
            ->willReturn(1);

        $doctorReviews
            ->countPublicReviews()
            ->willReturn(0);

        $sut = new DoctorReviewsService($doctorReviews->reveal());
        $dto = $sut->__invoke($doctor);

        $this->assertEquals("poor", $dto->rating);
        $this->assertFalse($dto->getShowPublicHealthReviews());
        $this->assertTrue($dto->showHeroReviews);
    }
}
