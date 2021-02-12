<?php

namespace FriendsOfInerta\Tests\Builder;

use FriendsOfInertia\LaravelSeo\Builder\MetaTagBuilder;
use FriendsOfInertia\LaravelSeo\Data\Tag;
use PHPUnit\Framework\TestCase;

class MetaTagBuilderTest extends TestCase
{
    public function test_it_can_add_title()
    {
        $builder = new MetaTagBuilder;
        $content = 'Test Title';

        $this->assertEmpty($builder->getTags());

        $builder->title($content);

        $tags = $builder->getTags();

        $this->assertCount(1, $tags);
        $this->assertArrayHasKey('title', $tags);
        $this->assertInstanceOf(Tag::class, $tags['title']);
        $this->assertEquals(Tag::TITLE, $tags['title']->getType());
        $this->assertEquals($content, $tags['title']->getContent());
    }

    public function test_it_can_add_description()
    {
        $builder = new MetaTagBuilder;
        $content = 'Test Description';

        $this->assertEmpty($builder->getTags());

        $builder->description($content);

        $tags = $builder->getTags();

        $this->assertCount(1, $tags);
        $this->assertArrayHasKey('description', $tags);
        $this->assertInstanceOf(Tag::class, $tags['description']);
        $this->assertEquals(Tag::META, $tags['description']->getType());
        $this->assertArrayHasKey('content', $tags['description']->getAttributes());
        $this->assertEquals($content, $tags['description']->getAttributes()['content']);
    }
}
