<?php

namespace FriendsOfInertia\LaravelSeo\Builder;

use FriendsOfInertia\LaravelSeo\Data\Tag;

class MetaTagBuilder extends AbstractBuilder
{
    /**
     * Creates a new title tag.
     *
     * @param  string  $title
     * @return self
     */
    public function title(string $title): self
    {
        return $this->addTag(
            Tag::new(Tag::TITLE)->setContent($title)->setUnique('title')
        );
    }

    /**
     * Creates a new meta tag with the description of the page.
     *
     * @param  string  $description
     * @return self
     */
    public function description(string $description): self
    {
        return $this->addTag(
            Tag::new(Tag::META)->setUnique('description')->setAttributes([
                'content' => $description,
                'name'    => 'description',
            ])
        );
    }
}
