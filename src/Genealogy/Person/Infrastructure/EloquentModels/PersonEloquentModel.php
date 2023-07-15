<?php

namespace Src\Genealogy\Person\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $full_name
 * @property int $gender
 * @property $birthday
 * @property int $parent_id
 * @property int $mother_id
 */
class PersonEloquentModel extends Model
{
    protected $table = 'persons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'gender',
        'birthday',
        'parent_id',
        'mother_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public array $rules = [
        'full_name' => 'required|string|max:255',
        'gender' => 'required',
    ];
}
