<?php

namespace FriendsOfInertia\LaravelSeo\Serializer\Encoder;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use FriendsOfInertia\LaravelSeo\Exception\InvalidTagType;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

class HtmlEncoder implements EncoderInterface
{
    public function encode($data, string $format, array $context = [])
    {
        foreach ($data as $key => $tag) {
            $data[$key] = $this->buildTag($tag);
        }

        return join("\n", $data);
    }

    public function buildTag(array $tag): string
    {
        $attributes = '';

        foreach ($tag['attributes'] as $name => $value) {
            $attributes .= " $name=\"$value\"";
        }

        switch ($tag['type']) {
            case Tag::META:
                $tag = "<meta{$attributes} />";
            break;

            case Tag::TITLE:
                $content = $tag['content'] ?? '';
                $tag     = "<title{$attributes}>{$content}</title>";
            break;

            default:
                throw new InvalidTagType('Unknown tag type ' . $tag['type'] . '.');
            break;
        }

        return $tag;
    }

    public function supportsEncoding(string $format, )
    {
        return $format === 'html';
    }
}
