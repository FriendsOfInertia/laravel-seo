<?php

namespace FriendsOfInertia\LaravelSeo\Serializer\Normalizer;

use FriendsOfInertia\LaravelSeo\Data\Tag;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TagNormalizer implements NormalizerInterface
{
    public function normalize($object, ?string $format = null, array $context = [])
    {
        return [
            'attributes' => $object->getAttributes(),
            'content'    => $object->getContent(),
            'type'       => $object->getType(),
            'unique'     => $object->getUnique(),
        ];
    }

    public function supportsNormalization($data, ?string $format = null)
    {
        return $data instanceof Tag && $format === 'html';
    }
}
