<?php

namespace FriendsOfInertia\LaravelSeo\Builder;

use FriendsOfInertia\LaravelSeo\Builder\Contract\BuilderContract;
use FriendsOfInertia\LaravelSeo\Data\Tag;
use FriendsOfInertia\LaravelSeo\Data\TagCollection;

abstract class AbstractBuilder implements BuilderContract
{
    protected TagCollection $tags;

    public function __construct(?TagCollection $tags = null)
    {
        $this->tags = $tags ?: new TagCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function addTag(Tag $tag): static
    {
        if ($tag->isUnique()) {
            $this->tags[$tag->getUnique()] = $tag;
        } else {
            $this->tags[] = $tag;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTags(): TagCollection
    {
        return $this->tags;
    }

    /**
     * {@inheritdoc}
     */
    public function setTags(TagCollection $tags): static
    {
        $this->tags = $tags;

        return $this;
    }
}
