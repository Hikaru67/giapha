<?php

namespace Src\Genealogy\Person\Domain\Model;

use Carbon\Carbon;
use Src\Common\Domain\AggregateRoot;

class Person extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $fullName,
        public readonly int $gender,
        public readonly ?Carbon $birthday,
        public readonly ?int $parentId,
        public readonly ?int $motherId,
    )
    {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->fullName,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'parent_id' => $this->parentId,
            'mother_id' => $this->motherId,
        ];
    }
}
