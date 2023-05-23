<?php

namespace App\Services\Enrollment;


use App\Services\Enrollment\Processors\EnrollmentProcessor;
use App\Services\Enrollment\Processors\FullSearchProcessor;
use App\Services\Enrollment\Processors\SingleSearchProcessor;
use Illuminate\Contracts\Container\Container;

class EnrollmentProcessorFactory
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getProcessor(bool $isFullSearch): EnrollmentProcessor
    {
        if ($isFullSearch) {
            return $this->container->make(FullSearchProcessor::class);
        }

        return $this->container->make(SingleSearchProcessor::class);
    }
}
