<?php

declare(strict_types=1);

namespace App\Links;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * Attributes guarded from mass-assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Scopes query by key.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKey(Builder $query, string $key): Builder
    {
        return $query->where('key', $key);
    }

    /**
     * Get the Link that corresponds to a key.
     *
     * @param string $key
     *
     * @return \App\Links\Link|null
     */
    public function forKey(string $key): ?Link
    {
        return $this->key($key)->first();
    }
}
