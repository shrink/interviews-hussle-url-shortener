<?php

declare(strict_types=1);

namespace Tests\Feature\Http;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that a link is created when a valid location is provided.
     */
    public function testLinkIsCreated(): void
    {
        $data = ['location' => 'https://www.example.com/'];

        $this->post('/', $data)->assertRedirect();

        $this->assertDatabaseHas('links', [
            'location' => 'https://www.example.com/',
        ]);
    }

    /**
     * Tests that an error is returned when the location provided is not a valid
     * URL.
     */
    public function testInvalidLocationFailsValidation(): void
    {
        $data = ['location' => 'invalid-link'];

        $this->post('/', $data)->assertSessionHasErrors();
    }
}
