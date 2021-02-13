<?php

namespace FriendsOfInerta\Tests\Serializer\Normalizer;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use FriendsOfInertia\LaravelSeo\Serializer\Normalizer\MetaTagNormalizer;
use PHPUnit\Framework\TestCase;

class MetaTagNormalizerTest extends TestCase
{
    public function test_it_can_normalize_tag()
    {
        $normalizer = new MetaTagNormalizer;
        $tag = $this->createTag();

        $this->assertTrue($normalizer->supportsNormalization($tag, 'seo:html'));
        $this->assertEquals(
            '<meta name="description" content="test description" />',
            $normalizer->normalize($tag)
        );
    }

    public function test_it_cannot_normalize_non_html_formats()
    {
        $normalizer = new MetaTagNormalizer;
        $tag = $this->createTag();

        $this->assertFalse($normalizer->supportsNormalization($tag, 'json'));
    }

    private function createTag(): Tag
    {
        return Tag::new(Tag::META)->setAttributes([
            'name' => 'description',
            'content' => 'test description',
        ]);
    }
}
