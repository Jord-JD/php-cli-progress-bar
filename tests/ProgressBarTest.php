<?php

namespace JordJD\CliProgressBar\Tests;

use JordJD\CliProgressBar\ProgressBar;
use PHPUnit\Framework\TestCase;

class ProgressBarTest extends TestCase
{
    public function testSettingInitialMaximumStartsTiming()
    {
        $progressBar = new ProgressBar();
        $this->setProperty($progressBar, 'startTime', 0);

        $before = time();
        $result = $progressBar->setMaxProgress(100);

        $this->assertSame($progressBar, $result);
        $this->assertGreaterThanOrEqual($before, $this->getProperty($progressBar, 'startTime'));
    }

    public function testStartResetsTimingSamples()
    {
        $progressBar = new ProgressBar();
        $this->setProperty($progressBar, 'advancementTimings', [10]);
        $this->setProperty($progressBar, 'startTime', 0);

        $result = $progressBar->start();

        $this->assertSame($progressBar, $result);
        $this->assertSame([], $this->getProperty($progressBar, 'advancementTimings'));
        $this->assertGreaterThan(0, $this->getProperty($progressBar, 'startTime'));
    }

    public function testSmallProgressBarsKeepAtLeastOneTimingSample()
    {
        $progressBar = new ProgressBar();
        $progressBar->setMaxProgress(2)->advance();

        $this->assertCount(1, $this->getProperty($progressBar, 'advancementTimings'));
    }

    private function getProperty($object, $propertyName)
    {
        $property = new \ReflectionProperty($object, $propertyName);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

    private function setProperty($object, $propertyName, $value)
    {
        $property = new \ReflectionProperty($object, $propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }
}
