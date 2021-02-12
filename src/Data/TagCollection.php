<?php

namespace FriendsOfInertia\LaravelSeo\Data;

use Illuminate\Support\Collection;

class TagCollection extends Collection
{
    public function offsetGet($key): Tag
    {
        return parent::offsetGet($key);
    }
}
