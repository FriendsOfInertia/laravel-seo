<?php

namespace FriendsOfInerta\Tests\Data;

use FriendsOfInertia\LaravelSeo\Data\TagCollection;
use PHPUnit\Framework\TestCase;
use TypeError;

class TagCollectionTest extends TestCase
{
    public function test_it_must_return_tag()
    {
        $this->expectException(TypeError::class);

        $collection   = new TagCollection;
        $collection[] = 'test';

        $collection[0];
    }
}
