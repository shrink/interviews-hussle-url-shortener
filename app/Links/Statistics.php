<?php

declare(strict_types=1);

namespace App\Links;

use Illuminate\Support\Collection;

class Statistics
{
    /**
     * Link model.
     *
     * @var \App\Links\Link
     */
    protected $links;

    /**
     * Visit model.
     *
     * @var \App\Links\Visit
     */
    protected $visits;

    /**
     * Constructs a new Statistics provider.
     *
     * @param \App\Links\Link $links
     * @param \App\Links\Visit $visits
     */
    public function __construct(Link $links, Visit $visits)
    {
        $this->links = $links;
        $this->visits = $visits;
    }

    /**
     * Provides all statistics.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return new Collection([
            new Statistic('URLs Shortened', $this->links->count()),
            new Statistic('Short URL visits', $this->visits->count()),
            new Statistic('Short URL visits today', $this->visits->today()->count()),
        ]);
    }

    /**
     * Provides statistics for one link.
     *
     * @param \App\Links\Link $link
     *
     * @return \Illuminate\Support\Collection
     */
    public function for(Link $link): Collection
    {
        return new Collection([
            new Statistic('Visits today', $link->visits()->today()->count()),
            new Statistic('Total visits', $link->visits()->count()),
            new Statistic('Unique visits', $link->visits()->unique()->get()->count()),
        ]);
    }
}
