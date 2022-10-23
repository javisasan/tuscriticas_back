<?php

namespace App\SharedKernel\Domain\ValueObject;

class Uuid
{
    /** @var string  */
    protected $id;

    public function __construct(string $id = null)
    {
        $this->id = $id ?: \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function equals(Uuid $uuid): bool
    {
        return $this->id() === $uuid->id();
    }

    public function __toString(): string
    {
        return $this->id();
    }
}
