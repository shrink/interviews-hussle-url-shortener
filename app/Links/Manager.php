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
        return tap($this->links->newInstance([
            'location' => $location,
            'key' => $this->generator->generate(6),
        ]))->save();
    }

    /**
     * Find a Link.
     *
     * @param string $key
     *
     * @return \App\Links\Link|null
     */
    public function find(string $key): ?Link
    {
        return $this->links->forKey($key);
    }

    /**
     * Visit a Link: find it and log a visit with a link-specific hash
     * identifying the user by their IP address without storing IP addresses.
     *
     * @param string $key
     * @param string $ip
     *
     * @return \App\Links\Link|null
     */
    public function visit(string $key, string $ip): ?Link
    {
        if (! $link = $this->find($key)) {
            return null;
        }

        $link->visits()->create([
            'visitor_hash' => sha1("{$key}-{$ip}"),
        ]);

        return $link;
    }
}
