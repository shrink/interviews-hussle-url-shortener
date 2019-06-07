<?php

declare(strict_types=1);

namespace Tests\Feature\App\Links;

use App\Links\Link;
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

    /**
     * Tests that the `key` scope filters query by key.
     */
    public function testKeyScopeLimitsByKey(): void
    {
        $expected = factory(Link::class)->create([
            'key' => 'a',
        ]);

        $others = factory(Link::class, 2)->create();

        $result = (new Link)->key('a');

        $this->assertEquals($expected->id, $result->first()->id);
        $this->assertCount(1, $result->get());
    }

    /**
     * Tests `forKey` provides the Link that corresponds to a key.
     */
    public function testForKeyProvidesLinkWithKey(): void
    {
        $expected = factory(Link::class)->create([
            'key' => 'a',
        ]);

        $result = (new Link)->forKey('a');

        $this->assertEquals($expected->id, $result->id);
    }
}
