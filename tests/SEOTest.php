<?php

namespace FriendsOfInertia\Tests\LaravelSEO;

use DateTime;
use FriendsOfInertia\LaravelSEO\Driver\MetaTagDriver;
use FriendsOfInertia\LaravelSEO\Driver\OpenGraphDriver;
use FriendsOfInertia\LaravelSEO\Exception\InvalidDriverException;
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
}
