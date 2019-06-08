<?php

declare(strict_types=1);

namespace Tests\Feature\Http;

use App\Links\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that a request to the shortened URL redirects to the intended
     * location.
     */
    public function testShortenedLinkRedirectsToLocation(): void
    {
        factory(Link::class)->create([
            'key' => 'shortkey',
            'location' => 'https://www.example.com/',
        ]);

        $this->get('/shortkey')->assertLocation('https://www.example.com/');
    }

    /**
     * Tests that a request to the a short URL that doesn't exist returns an
     * error.
     */
    public function testInvalidKeyReturnsError(): void
    {
        $this->get('/invalid')->assertStatus(404);
    }
}
