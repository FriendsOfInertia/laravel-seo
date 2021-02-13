<?php

namespace FriendsOfInertia\LaravelSeo\Serializer\Encoder;

use Symfony\Component\Serializer\Encoder\EncoderInterface;

class SeoHtmlEncoder implements EncoderInterface
{
    public function encode($data, string $format, array $context = [])
    {
        return join("\n", $data);
    }

    public function supportsEncoding(string $format, )
    {
        return $format === 'seo:html';
    }
}
