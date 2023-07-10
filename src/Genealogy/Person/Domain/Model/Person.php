<?php

namespace Src\Genealogy\Person\Domain\Model;

use Src\Common\Domain\AggregateRoot;

class Person extends AggregateRoot implements \JsonSerializable
{
    public function __construct(
        // TODO Add properties
    )
    {}

    public function toArray(): array
    {
        return [
            // TODO Add properties
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}