<?php

namespace FriendsOfInertia\LaravelSEO;

use FriendsOfInertia\LaravelSEO\Driver\Contract\DriverContract;
use FriendsOfInertia\LaravelSEO\Exception\InvalidDriverException;

/**
 * The SEO class itself handles the instances we have of each driver. This will
 * be provided to Laravel as a singleton and shipped with a facade helper.
 */
class SEO
{
    private array $drivers = [];

    /***************************************************************************
     * Common SEO helpers are things that are repetitive. These are passed to
     * each driver that supports them.
     **************************************************************************/

    public function description(string $description)
    {
        return $this->callDriverMethod('description', $description);
    }

    public function title(string $title): SEO
    {
        return $this->callDriverMethod('title', $title);
    }

    /***************************************************************************
     * Driver utilities
     **************************************************************************/

    /**
     * Returns the requested driver.
     */
    public function driver(string $id): DriverContract
    {
        if (isset($this->drivers[$id])) {
            return $this->drivers[$id];
        }

        throw new InvalidDriverException("Unknown SEO driver {$id}.");
    }

    /**
     * Returns all the drivers registered with the class.
     */
    public function drivers(): array
    {
        return $this->drivers;
    }

    /**
     * Registers a new driver with the SEO class. This driver can then be used
     * to create meta data.
     */
    public function registerDriver(string $id, DriverContract $driver): SEO
    {
        $this->drivers[$id] = $driver;

        return $this;
    }

    /**
     * Calls the specified method on all drivers that support it.
     */
    private function callDriverMethod(string $method, string ...$arguments): SEO
    {
        foreach ($this->drivers() as $driver) {
            if (! method_exists($driver, $method)) {
                continue;
            }

            $driver->{$method}(...$arguments);
        }

        return $this;
    }
}
