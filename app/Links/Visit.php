<?php

declare(strict_types=1);

namespace App\Links;

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
}
