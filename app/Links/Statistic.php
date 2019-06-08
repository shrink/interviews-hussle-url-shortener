<?php

declare(strict_types=1);

namespace App\Links;

class Statistic
{
    /**
     * Name of the statistic.
     *
     * @var string
     */
    protected $name;

    /**
     * Amount of the statistic.
     *
     * @var int
     */
    protected $amount;

    /**
     * Constructs a new statistic.
     *
     * @param string $name
     * @param int $amount
     */
    public function __construct(string $name, int $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    /**
     * Get the name of the statistic.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Get the amount of the statistic.
     *
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }
}
