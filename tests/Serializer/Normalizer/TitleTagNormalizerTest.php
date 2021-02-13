<?php

namespace FriendsOfInerta\Tests\Serializer\Normalizer;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use FriendsOfInertia\LaravelSeo\Serializer\Normalizer\TitleTagNormalizer;
use PHPUnit\Framework\TestCase;

class TitleTagNormalizerTest extends TestCase
{
    public function test_it_can_normalize_tag()
    {
        $normalizer = new TitleTagNormalizer;
        $tag = $this->createTag();

        $this->assertTrue($normalizer->supportsNormalization($tag, 'seo:html'));
        $this->assertEquals('<title id="my-page-title">Page Title</title>', $normalizer->normalize($tag));
    }

    public function test_it_cannot_normalize_non_html_formats()
    {
        $normalizer = new TitleTagNormalizer;
        $tag = $this->createTag();

        $this->assertFalse($normalizer->supportsNormalization($tag, 'json'));
    }

    private function createTag(): Tag
    {
        return Tag::new(Tag::TITLE)->setAttributes([
            'id' => 'my-page-title',
        ])->setContent('Page Title');
    }
}
