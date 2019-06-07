<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Link;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that a link cannot be created with a key that already exists.
     */
    public function testDatabaseEnforcesUniqueKey(): void
    {
        $this->expectException(QueryException::class);

        factory(Link::class)->create([
            'key' => 'a',
        ]);

        factory(Link::class)->create([
            'key' => 'a',
        ]);
    }
}
