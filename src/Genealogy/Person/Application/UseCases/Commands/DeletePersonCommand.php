<?php

namespace Src\Genealogy\Person\Application\UseCases\Commands;

use Src\Common\Domain\CommandInterface;
use Src\Genealogy\Person\Domain\Model\Person;
use Src\Genealogy\Person\Domain\Policies\PersonPolicy;
use Src\Genealogy\Person\Domain\Repositories\PersonRepositoryInterface;

class DeletePersonCommand implements CommandInterface
{
    private PersonRepositoryInterface $repository;

    public function __construct(
        private readonly Person $person
    )
    {
        $this->repository = app()->make(PersonRepositoryInterface::class);
    }

    public function execute(): mixed
    {
        authorize('delete', PersonPolicy::class);
        return $this->repository->delete($this->person);
    }
}