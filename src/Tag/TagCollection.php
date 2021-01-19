<?php

namespace FriendsOfInertia\LaravelSEO\Tag;

use Illuminate\Support\Collection;

class TagCollection extends Collection
{
    public function offsetGet($key): AbstractTag
    {
        return parent::offsetGet($key);
    }
}
