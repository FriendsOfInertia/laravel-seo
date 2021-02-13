<?php

namespace FriendsOfInertia\LaravelSeo\Builder\Contract;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use FriendsOfInertia\LaravelSeo\Data\TagCollection;

interface BuilderContract
{
    /**
     * Adds a single tag to the collection.
     *
     * @return static
     */
    public function addTag(Tag $tag): self;

    /**
     * Returns all the tags in the collection.
     *
     * @return TagCollection
     */
    public function getTags(): TagCollection;

    /**
     * Sets the tags in the collection.
     *
     * @return static
     */
    public function setTags(TagCollection $tags): self;
}
