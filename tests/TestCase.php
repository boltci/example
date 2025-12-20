<?php

namespace Tests;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

abstract class TestCase extends BaseTestCase
{
    use DatabaseTransactions;

    #[Test, DataProvider('provider')]
    public function it_works($writeCount, $readCount): void
    {
        UserFactory::new()->count($writeCount)->create();

        for($i = 0; $i < $readCount; $i++) {
            User::query()->inRandomOrder()->first();
        }

        $this->get('/')->assertSuccessful();
    }

    public static function provider(): array
    {
        $lightLoad = [
            'writeCount' => 1,
            'readCount' => 1,
        ];

        $mediumLoad = [
            'writeCount' => 10,
            'readCount' => 10,
        ];

        $heavyLoad = [
            'writeCount' => 100,
            'readCount' => 100,
        ];

        return [
            ...array_fill(0, 100, $lightLoad),
            ...array_fill(0, 100, $mediumLoad),
            ...array_fill(0, 100, $heavyLoad),
        ];
    }
}
