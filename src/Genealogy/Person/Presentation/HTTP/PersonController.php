<?php

namespace Src\Genealogy\Person\Presentation\HTTP;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Common\Domain\Exceptions\UnauthorizedUserException;
use Src\Genealogy\Person\Application\Mappers\PersonMapper;
use Src\Genealogy\Person\Application\UseCases\Commands\DeletePersonCommand;
use Src\Genealogy\Person\Application\UseCases\Commands\StorePersonCommand;
use Src\Genealogy\Person\Application\UseCases\Commands\UpdatePersonCommand;
use Src\Genealogy\Person\Application\UseCases\Queries\FindAllPersonsQuery;
use Src\Genealogy\Person\Application\UseCases\Queries\FindPersonByIdQuery;
use Symfony\Component\HttpFoundation\Response;

class PersonController
{
    public function index(): JsonResponse
    {
        try {
            return response()->json((new FindAllPersonsQuery())->handle());
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json((new FindPersonByIdQuery($id))->handle());
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $person = PersonMapper::fromRequest($request);
            $personData = (new StorePersonCommand($person))->execute();
            return response()->json($personData, Response::HTTP_CREATED);
        } catch (\DomainException $domainException) {
            return response()->json(['error' => $domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $person = PersonMapper::fromRequest($request, $id);
            (new UpdatePersonCommand($person))->execute();
            return response()->json($person, Response::HTTP_OK);
        } catch (\DomainException $domainException) {
            return response()->json(['error' => $domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            (new DeletePersonCommand($id))->execute();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (UnauthorizedUserException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

}