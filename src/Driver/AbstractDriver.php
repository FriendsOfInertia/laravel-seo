<?php

namespace FriendsOfInertia\LaravelSEO\Driver;

use FriendsOfInertia\LaravelSEO\Driver\Contract\DriverContract;
use FriendsOfInertia\LaravelSEO\Tag\TagCollection;

abstract class AbstractDriver implements DriverContract
{
    protected TagCollection $tags;

    public function __construct()
    {
        $this->tags = new TagCollection;
    }

    public function getTags(): TagCollection
    {
        return $this->tags;
    }
}
