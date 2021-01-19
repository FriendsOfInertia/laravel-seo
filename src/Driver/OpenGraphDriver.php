<?php

namespace FriendsOfInertia\LaravelSEO\Driver;

use FriendsOfInertia\LaravelSEO\Driver\Concern\CreatesMetaProperties;

class OpenGraphDriver extends AbstractDriver
{
    use CreatesMetaProperties;

    protected string $prefix = 'og:';

    public function description(string $description): OpenGraphDriver
    {
        $this->tags['description'] = $this->createMetaProperty('description', $description);

        return $this;
    }

    public function title(string $title): OpenGraphDriver
    {
        $this->tags['title'] = $this->createMetaProperty('title', $title);

        return $this;
    }
}
