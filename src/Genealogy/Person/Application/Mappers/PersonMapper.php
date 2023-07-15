<?php

namespace Src\Genealogy\Person\Application\Mappers;

use Illuminate\Http\Request;
use Src\Genealogy\Person\Domain\Model\Person;
use Src\Genealogy\Person\Infrastructure\EloquentModels\PersonEloquentModel;

class PersonMapper
{
    public static function fromRequest(Request $request, ?int $userId = null): Person
    {
        return new Person(
            id: $userId,
            fullName: $request->string('full_name'),
            gender: $request->input('gender'),
            birthday: $request->input('birthday'),
            parentId: $request->input('parent_id'),
            motherId: $request->input('mother_id'),
        );
    }

    public static function fromEloquent(PersonEloquentModel $personEloquent): Person
    {
        return new Person(
            id: $personEloquent->id,
            fullName: $personEloquent->full_name,
            gender: $personEloquent->gender,
            birthday: $personEloquent->birthday,
            parentId: $personEloquent->parent_id,
            motherId: $personEloquent->mother_id,
        );
    }

    public static function toEloquent(Person $person): PersonEloquentModel
    {
        $personEloquent = new PersonEloquentModel();
        if ($person->id) {
            $personEloquent = PersonEloquentModel::query()->findOrFail($person->id);
        }

        $personEloquent->full_name = $person->fullName;
        $personEloquent->gender = $person->gender;
        $personEloquent->birthday = $person->birthday;
        $personEloquent->parent_id = $person->parentId;
        $personEloquent->mother_id = $person->motherId;

        return $personEloquent;
    }
}
