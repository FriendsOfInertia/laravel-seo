<?php

namespace FriendsOfInertia\LaravelSEO\Driver\Concern;

use FriendsOfInertia\LaravelSEO\Tag\MetaTag;

trait CreatesMetaProperties
{
    protected function createMetaProperty(string $property, string $content): MetaTag
    {
        if (isset($this->prefix)) {
            $property = $this->prefix . $property;
        }

        return new MetaTag([
            'attributes' => [
                'property' => $property,
                'content'  => $content,
            ]
        ]);
    }
}
