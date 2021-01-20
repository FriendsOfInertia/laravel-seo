<?php

namespace FriendsOfInertia\LaravelSEO\Driver;

use FriendsOfInertia\LaravelSEO\Tag\MetaTag;
use FriendsOfInertia\LaravelSEO\Tag\TitleTag;

class MetaTagDriver extends AbstractDriver
{
    public function description(string $description): MetaTagDriver
    {
        $this->tags['description'] = new MetaTag([
            'attributes' => [
                'name'    => 'description',
                'content' => $description,
            ],
        ]);

        return $this;
    }

    public function title(string $title): MetaTagDriver
    {
        $this->tags['title'] = new TitleTag(['content' => $title]);

        return $this;
    }

    /**
     * @param string|string[] $keywords
     */
    public function keywords($keywords): MetaTagDriver
    {
        $this->tags['keywords'] = new MetaTag([
            'attributes' => [
                'name' => 'keywords',
                'content' => is_array($keywords) ? implode(', ', $keywords) : $keywords,
            ],
        ]);

        return $this;
    }
}
