<?php

namespace FriendsOfInertia\LaravelSEO\Tag;

use Spatie\DataTransferObject\DataTransferObject;

abstract class AbstractTag extends DataTransferObject
{
    public ?array $attributes;
}
