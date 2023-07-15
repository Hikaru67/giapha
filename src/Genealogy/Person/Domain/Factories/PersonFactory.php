<?php

namespace Src\Genealogy\Person\Domain\Factories;

use Src\Genealogy\Person\Domain\Model\Person;

class PersonFactory
{
    public static function new(array $attributes = []): Person
    {
        $defaults = [
            'full_name' => fake()->name(),
            'birthday' => fake()->dateTime(),
            'gender' => random_int(1, 2),
            'parent_id' => null,
            'mother_id' => null,
        ];

        $attributes = array_replace($defaults, $attributes);

        return (new Person(
            id: null,
            fullName: $attributes['full_name'],
            gender: $attributes['gender'],
            birthday: $attributes['birthday'],
            parentId: $attributes['parent_id'],
            motherId: $attributes['mother_id'],
        ));
    }
}
