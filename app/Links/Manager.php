<?php

declare(strict_types=1);

namespace App\Links;

use App\Links\Link;
use App\Links\KeyGenerator;

class Manager
{
    /**
     * Link model that provides access to the datastore.
     *
     * @var \App\Links\Link
     */
    protected $links;

    /**
     * Key generator that provides unique link keys.
     *
     * @var \App\Links\KeyGenerator
     */
    protected $generator;

    /**
     * Constructs a new Link manager.
     *
     * @param \App\Links\Link
     * @param \App\Links\KeyGenerator
     */
    public function __construct(Link $links, KeyGenerator $generator)
    {
        $this->links = $links;
        $this->generator = $generator;
    }

    /**
     * Creates a new Link.
     *
     * @param string $location
     *
     * @return \App\Links\Link
     */
    public function create(string $location): Link
    {
        return $this->links->save([
            'location' => $location,
            'key' => $this->generator->generate(6),
        ]);
    }
}
