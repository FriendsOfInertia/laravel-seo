<?php

namespace FriendsOfInertia\Tests\LaravelSEO;

use DateTime;
use FriendsOfInertia\LaravelSEO\Driver\MetaTagDriver;
use FriendsOfInertia\LaravelSEO\Driver\OpenGraphDriver;
use FriendsOfInertia\LaravelSEO\Exception\InvalidDriverException;
use FriendsOfInertia\LaravelSEO\Exception\InvalidDriverMethodException;
use FriendsOfInertia\LaravelSEO\SEO;
use PHPUnit\Framework\TestCase;
use TypeError;

class SEOTest extends TestCase
{
    public function test_it_cannot_get_driver_that_does_not_exist()
    {
        $this->expectException(InvalidDriverException::class);
        $this->expectExceptionMessage('Unknown SEO driver openGraph.');

        $seo = new SEO;
        $seo->driver('openGraph');
    }

    public function test_it_can_get_driver_that_exists()
    {
        $seo = new SEO;
        $seo->registerDriver('openGraph', new OpenGraphDriver);

        $driver = $seo->driver('openGraph');

        $this->assertInstanceOf(OpenGraphDriver::class, $driver);
    }

    public function test_it_cannot_register_invalid_driver()
    {
        $this->expectException(TypeError::class);

        $seo = new SEO;
        $seo->registerDriver('dateTime', new DateTime());
    }

    public function test_it_passes_title_calls_onto_drivers()
    {
        $seo = new SEO;
        $seo->registerDriver('openGraph', new OpenGraphDriver);
        $seo->registerDriver('meta', new MetaTagDriver);

        // Assert the drivers start out with no tags
        foreach ($seo->drivers() as $driver) {
            $this->assertEmpty($driver->getTags());
        }

        $seo->title('Test Title');

        // Assert the drivers end with 1 tag (unless they don't have the title method)
        foreach ($seo->drivers() as $driver) {
            if (! method_exists($driver, 'title')) {
                $this->assertEmpty($driver->getTags());

                continue;
            }

            $this->assertCount(1, $driver->getTags());
        }
    }

    public function test_it_does_not_pass_unknown_onto_drivers()
    {
        $this->expectException(InvalidDriverMethodException::class);

        $seo = new SEO;
        $seo->registerDriver('openGraph', new OpenGraphDriver);
        $seo->registerDriver('meta', new MetaTagDriver);

        $seo->unknown('Test');
    }

    public function test_it_forwards_keywords_to_meta_tag_driver()
    {
        $seo = new SEO;
        $seo->registerDriver('openGraph', new OpenGraphDriver);
        $seo->registerDriver('meta', new MetaTagDriver);

        $seo->keywords(['InertiaJS', 'PHP', 'Laravel']);

        $openGraphDriver = $seo->driver('openGraph');
        $this->assertCount(0, $openGraphDriver->getTags());

        $metaDriver = $seo->driver('meta');
        $this->assertCount(1, $metaDriver->getTags());
        $this->assertTrue($metaDriver->getTags()->has('keywords'));
        $this->assertSame([
            'name' => 'keywords',
            'content' => 'InertiaJS, PHP, Laravel',
        ], $metaDriver->getTags()->get('keywords')->attributes);
    }

    public function test_it_can_return_the_driver_through_magic_method()
    {
        $seo = new SEO;
        $seo->registerDriver('openGraph', new OpenGraphDriver);
        $seo->registerDriver('meta', new MetaTagDriver);

        $openGraphDriver = $seo->openGraphDriver();
        $this->assertInstanceOf(OpenGraphDriver::class, $openGraphDriver);

        $metaDriver = $seo->metaDriver();
        $this->assertInstanceOf(MetaTagDriver::class, $metaDriver);
    }
}
