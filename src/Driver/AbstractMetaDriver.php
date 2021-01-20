<?php

namespace FriendsOfInertia\LaravelSEO\Driver;

use FriendsOfInertia\LaravelSEO\Tag\MetaTag;

/**
 * This class abstracts various functions that are useful when building meta
 * tags.
 */
abstract class AbstractMetaDriver extends AbstractDriver
{
    protected ?string $prefix;

    protected function createMetaPropertyTag(string $property, string $content)
    {
        if (isset($this->prefix)) {
            $property = $this->prefix . $property;
        }

        return new MetaTag([
            'attributes' => [
                'property' => $property,
                'content'  => $content,
            ],
        ]);
    }
}
