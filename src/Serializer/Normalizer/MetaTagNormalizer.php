<?php

namespace FriendsOfInertia\LaravelSeo\Serializer\Normalizer;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MetaTagNormalizer implements NormalizerInterface
{
    public function normalize($object, ?string $format = null, array $context = [])
    {
        $html = '<meta';

        foreach ($object->getAttributes() as $attribute => $value) {
            $html .= " {$attribute}=\"{$value}\"";
        }

        return $html .= ' />';
    }

    public function supportsNormalization($data, ?string $format = null)
    {
        return (
            $data instanceof Tag &&
            $data->getType() == Tag::META &&
            $format == 'seo:html'
        );
    }
}
