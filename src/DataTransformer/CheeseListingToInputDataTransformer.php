<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;

class CheeseListingToInputDataTransformer implements DataTransformerInterface
{
    public function transform($object, string $to, array $context = [])
    {
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
    }
}