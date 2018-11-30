<?php

namespace DrHero\Services;

use DrHero\Doctor\Doctor;



class DoctorSubscriberService
{

    private $adapterFactory;
    private $subscriberAdapter;


    public function __construct(
        AdapterFactory $adapterFactory
    )
    {
        $this->adapterFactory = $adapterFactory;
    }

    public function subscribeDoctor(Doctor $doctor)
    {
        $this->subscriberAdapter = $this->adapterFactory->buildAdapter($doctor);
        $this->subscriberAdapter->addSubscriber($doctor);
    }
}