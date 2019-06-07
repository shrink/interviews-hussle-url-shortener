<?php

declare(strict_types=1);

namespace App\Links;

use App\Links\Link;

class KeyGenerator
{
    /**
     * Link model that provides access to the datastore.
     *
     * @var \App\Links\Link
     */
    protected $links;

    /**
     * Constructs a new Key Generator.
     *
     * @param \App\Links\Link $links
     */
    public function __construct(Link $links)
    {
        $this->links = $links;
    }

    /**
     * Generates a new unique key (string) of length.
     *
     * @param int $length
     *
     * @return string
     */
    public function generate(int $length): string
    {
        while ($key = $this->createRandomString($length)) {
            if ($this->isKeyAvailable($key)) {
                break;
            }
        }

        return $key;
    }

    /**
     * Is this key available?
     *
     * @param string $key
     *
     * @return bool
     */
    protected function isKeyAvailable(string $key): bool
    {
        return $this->links->forKey($key) === null;
    }

    /**
     * Create a random string of $length characters.
     *
     * @param int $length
     *
     * @return string
     */
    protected function createRandomString(int $length): string
    {
        return str_random($length);
    }
}
