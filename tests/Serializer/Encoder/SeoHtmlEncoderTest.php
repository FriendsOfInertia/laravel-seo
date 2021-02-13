<?php

namespace FriendsOfInerta\Tests\Serializer\Encoder;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use FriendsOfInertia\LaravelSeo\Data\TagCollection;
use FriendsOfInertia\LaravelSeo\Serializer\Encoder\SeoHtmlEncoder;
use FriendsOfInertia\LaravelSeo\Serializer\Normalizer\MetaTagNormalizer;
use FriendsOfInertia\LaravelSeo\Serializer\Normalizer\TagCollectionNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Serializer;

class SeoHtmlEncoderTest extends TestCase
{
    public function test_it_can_encode_html_tags()
    {
        $encoder    = $this->createSerializer();
        $collection = $this->createCollection();

        // Encode the collection
        $encodedCollection = $encoder->serialize($collection, 'seo:html');

        // Make assertions
        $expected = join(PHP_EOL, [
            '<meta name="description" content="test description" />',
            '<meta name="viewport" content="width=device-width, initial-scale=1.0" />',
        ]);

        $this->assertEquals($expected, $encodedCollection);
    }

    public function test_it_cannot_encode_non_html()
    {
        $this->expectException(NotEncodableValueException::class);

        $encoder    = $this->createSerializer();
        $collection = $this->createCollection();

        // Encode the collection
        $encoder->serialize($collection, 'json');
    }

    private function createCollection()
    {
        return new TagCollection([
            Tag::new(Tag::META)->setAttributes([
                'name'    => 'description',
                'content' => 'test description',
            ]),

            Tag::new(Tag::META)->setAttributes([
                'name'    => 'viewport',
                'content' => 'width=device-width, initial-scale=1.0',
            ]),
        ]);
    }

    private function createSerializer()
    {
        return new Serializer(
            [
                new TagCollectionNormalizer,
                new MetaTagNormalizer,
            ],
            [
                new SeoHtmlEncoder,
            ]
        );
    }
}
