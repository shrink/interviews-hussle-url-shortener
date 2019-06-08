<?php

declare(strict_types=1);

namespace App\Links;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    /**
     * Attributes guarded from mass-assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Link that this visit was to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }

    /**
     * Scope visits that happened today.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->where('created_at', '>=', (new Carbon)->today());
    }

    /**
     * Scope visits that are unique.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnique(Builder $query): Builder
    {
        return $query->groupBy('visitor_hash');
    }
}
