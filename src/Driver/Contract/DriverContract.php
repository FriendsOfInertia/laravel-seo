<?php

namespace FriendsOfInertia\LaravelSEO\Driver\Contract;

use FriendsOfInertia\LaravelSEO\Tag\TagCollection;

interface DriverContract
{
    public function getTags(): TagCollection;
}
