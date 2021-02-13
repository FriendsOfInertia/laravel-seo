<?php

namespace FriendsOfInerta\Tests\Serializer\Normalizer;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use FriendsOfInertia\LaravelSeo\Data\TagCollection;
use FriendsOfInertia\LaravelSeo\Serializer\Normalizer\MetaTagNormalizer;
use FriendsOfInertia\LaravelSeo\Serializer\Normalizer\TagCollectionNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Serializer;

class TagCollectionNormalizerTest extends TestCase
{
    public function test_it_can_normalize_tag_collection()
    {
        $normalizer = $this->createSerializer();
        $collection = $this->createCollection();
        $normalizedCollection = $normalizer->normalize($collection, 'seo:html');

        $this->assertTrue($normalizer->supportsNormalization($collection, 'seo:html'));
        $this->assertIsArray($normalizedCollection);
        $this->assertArrayHasKey(0, $normalizedCollection);
        $this->assertEquals(
            '<meta name="description" content="test description" />',
            $normalizedCollection[0]
        );
    }

    public function test_it_cannot_normalize_non_html_formats()
    {
        $normalizer = $this->createSerializer();
        $collection = $this->createCollection();

        $this->assertFalse($normalizer->supportsNormalization($collection, 'json'));
    }

    private function createCollection(): TagCollection
    {
        return new TagCollection([
            Tag::new(Tag::META)->setAttributes([
                'name' => 'description',
                'content' => 'test description',
            ])
        ]);
    }

    /**
     * Because multiple normalizers are involved in getting a collection into HTML,
     * we want to create a new serializer to handle the normalization.
     * 
     * @return Serializer
     */
    private function createSerializer(): Serializer
    {
        return new Serializer([
            new TagCollectionNormalizer,
            new MetaTagNormalizer
        ]);
    }
}
