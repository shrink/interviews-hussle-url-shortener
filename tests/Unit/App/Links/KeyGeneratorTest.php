<?php

declare(strict_types=1);

namespace Tests\Unit\App\Links;

use App\Links\KeyGenerator;
use App\Links\Link;
use Tests\TestCase;

class KeyGeneratorTest extends TestCase
{
    /**
     * Tests that when the randomly generated key already exists that the
     * process is repeated until an available key is found.
     */
    public function testKeysAreGeneratedUntilAvailableIsFound(): void
    {
        $link = $this->createMock(Link::class);

        $links = $this->createMock(Link::class);
        $links->expects($this->at(0))->method('forKey')->willReturn($link);
        $links->expects($this->at(1))->method('forKey')->willReturn($link);
        $links->expects($this->at(2))->method('forKey')->willReturn(null);

        (new KeyGenerator($links))->generate(6);
    }

    /**
     * Tests that a key is generated of the correct length.
     */
    public function testKeyOfCorrectLengthIsGenerated(): void
    {
        $links = $this->createMock(Link::class);
        $links->method('forKey')->willReturn(null);

        $key = (new KeyGenerator($links))->generate(6);

        $this->assertSame(6, strlen($key));
    }
}
