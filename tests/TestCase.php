<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

abstract class TestCase extends BaseTestCase
{
    #[Test, DataProvider('provider')]
    public function it_works($index): void
    {
        usleep(10 * 1000);

        $this->assertTrue(true);
    }

    public static function provider(): array
    {
        return array_fill(0, 100, []);
    }
}
