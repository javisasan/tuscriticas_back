<?php

declare(strict_types=1);

namespace CommonPlatform\SharedKernel\Domain\Service;

interface ResponseTransformer
{
    public function transform(): array;
}
