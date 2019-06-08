<?php

declare(strict_types=1);

namespace Tests\Feature\Http;

use App\Links\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MetaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that a key that does not exist returns a 404 when a request is made
     * to view the meta.
     */
    public function testInvalidKeyReturnsError(): void
    {
        $this->get('/~invalid')->assertStatus(404);
    }

    /**
     * Tests that when a key exists the meta view is provided.
     */
    public function testValidKeyReturnsView(): void
    {
        factory(Link::class)->create([
            'key' => 'valid',
        ]);

        $this->get('/~valid')->assertViewIs('links.meta');
    }
}
