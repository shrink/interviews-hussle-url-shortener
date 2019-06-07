<?php

declare(strict_types=1);

namespace Tests\Unit\App\Links;

use App\Links\KeyGenerator;
use App\Links\Link;
use App\Links\Manager;
use Tests\TestCase;

class ManagerTest extends TestCase
{
    /**
     * Tests that a link is created with a unique key provided by the key
     * generator.
     */
    public function testLinkIsCreatedWithUniqueKey(): void
    {
        $generator = $this->createMock(KeyGenerator::class);
        $generator->method('generate')->willReturn('a');

        $links = $this->createMock(Link::class);
        $links->expects($this->once())
            ->method('save')
            ->with([
                'location' => 'https://www.example.com/',
                'key' => 'a',
            ])
            ->willReturn($this->createMock(Link::class));

        $manager = new Manager($links, $generator);
        $manager->create('https://www.example.com/');
    }
}
