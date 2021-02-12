<?php

namespace FriendsOfInertia\LaravelSeo\Serializer\Normalizer;

use FriendsOfInertia\LaravelSeo\Data\TagCollection;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TagCollectionNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    public function normalize($object, ?string $format = null, array $context = [])
    {
        $normalizedTags = [];

        foreach ($object as $tag) {
            $normalizedTags[] = $this->normalizer->normalize($tag, $format);
        }

        return $normalizedTags;
    }

    public function supportsNormalization($data, ?string $format = null)
    {
        return $data instanceof TagCollection && $format == 'html';
    }
}
