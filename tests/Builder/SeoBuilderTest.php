<?php

namespace FriendsOfInerta\Tests\Builder;

use FriendsOfInertia\LaravelSeo\Builder\MetaTagBuilder;
use FriendsOfInertia\LaravelSeo\Builder\SeoBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SeoBuilderTest extends TestCase
{
    public function test_it_passes_calls_to_meta_builder()
    {
        $content = 'Testing!';

        $metaBuilder = $this->getMetaMock();

        $metaBuilder->expects($this->once())->method('setTags')->withAnyParameters();
        $metaBuilder->expects($this->once())->method('title')->with($content);
        $metaBuilder->expects($this->once())->method('description')->with($content);

        $builder = new SeoBuilder($metaBuilder);

        $builder->title($content);
        $builder->description($content);
    }

    public function test_meta_method_exposes_meta_builder()
    {
        $builder = new SeoBuilder($this->getMetaMock());
        $builder->meta(function ($meta) {
            $this->assertInstanceOf(MetaTagBuilder::class, $meta);
        });
    }

    private function getMetaMock(): MockObject
    {
        return $this->getMockBuilder(MetaTagBuilder::class)->getMock();
    }
}
