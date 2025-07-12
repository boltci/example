<?php

namespace Tests;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

abstract class TestCase extends BaseTestCase
{
    #[Test, DataProvider('provider')]
    public function it_works($foo): void
    {
        UserFactory::new()->create();

        usleep(1 * 1000);

        $this->assertTrue(true);
    }

    public static function provider(): array
    {
        return array_fill(0, 100, [
            'foo' => 'bar',
        ]);
    }
}
