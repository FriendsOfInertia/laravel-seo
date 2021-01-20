<?php

namespace FriendsOfInertia\LaravelSEO\Driver;

class OpenGraphDriver extends AbstractMetaDriver
{
    protected string $prefix = 'og:';

    public function description(string $description): OpenGraphDriver
    {
        $this->tags['description'] = $this->createMetaPropertyTag('description', $description);

        return $this;
    }

    public function title(string $title): OpenGraphDriver
    {
        $this->tags['title'] = $this->createMetaPropertyTag('title', $title);

        return $this;
    }
}
