<?php

namespace FriendsOfInertia\LaravelSeo\Serializer\Normalizer;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TitleTagNormalizer implements NormalizerInterface
{
    public function normalize($object, ?string $format = null, array $context = [])
    {
        $html = '<title';

        foreach ($object->getAttributes() as $attribute => $value) {
            $html .= " {$attribute}=\"{$value}\"";
        }

        $html .= '>';

        if ($object->hasContent()) {
            $html .= $object->getContent();
        }

        return $html .= '</title>';
    }

    public function supportsNormalization($data, ?string $format = null)
    {
        return (
            $data instanceof Tag &&
            $data->getType() == Tag::TITLE &&
            $format == 'seo:html'
        );
    }
}
