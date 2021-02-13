<?php

namespace FriendsOfInerta\Tests\Data;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use FriendsOfInertia\LaravelSeo\Exception\InvalidTagType;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public function test_it_can_set_attributes()
    {
        $attributes = ['content' => 'test', 'name' => 'test'];
        $tag        = Tag::new(Tag::META);

        $this->assertFalse($tag->hasAttributes());

        $tag->setAttributes($attributes);

        $this->assertEquals($attributes, $tag->getAttributes());
        $this->assertTrue($tag->hasAttributes());
    }

    public function test_it_can_set_content()
    {
        $content = 'Some test tag content';
        $tag     = Tag::new(Tag::META);

        $this->assertFalse($tag->hasContent());

        $tag->setContent($content);

        $this->assertTrue($tag->hasContent());
        $this->assertEquals($content, $tag->getContent());
    }

    public function test_it_cannot_set_type_unless_allowed()
    {
        $this->expectException(InvalidTagType::class);

        Tag::new('test');
    }

    public function test_it_can_set_allowed_type()
    {
        $tag = Tag::new(Tag::META);

        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertEquals(Tag::META, $tag->getType());
    }

    public function test_it_can_set_unique()
    {
        $key = 'unique!';
        $tag = Tag::new(Tag::TITLE);

        $this->assertFalse($tag->isUnique());

        $tag->setUnique($key);

        $this->assertTrue($tag->isUnique());
        $this->assertEquals($key, $tag->getUnique());
    }
}
