<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\RemoveUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function getUsers(): Response
    {
        $result = (new UserRepository())->findAll();

        return Response($result);
    }

    public function createUser(CreateUserRequest $request): Response
    {
        if (! $request->validate()) {
            return Response($request->errors(), 400);
        }

        $user = new User();
        $user->name = $request->getName();
        $user->last_name = $request->getLastName();
        $user->save();

        return Response([]);
    }

    public function removeUser(RemoveUserRequest $request): Response
    {
        if (! $request->validate()) {
            return Response($request->errors(), 400);
        }

        try {
            $user = (new UserRepository())->findById($request->getId());
        } catch (ModelNotFoundException $e) {
            return Response($e->message, 400);
        }

        $user->delete();

        return Response([]);
    }

    public function updateUser(UpdateUserRequest $request): Response
    {
        if (! $request->validate()) {
            return Response($request->errors(), 400);
        }

        try {
            $user = (new UserRepository())->findById($request->getId());
        } catch (ModelNotFoundException $e) {
            return Response($e->message, 400);
        }

        $user->name = $request->getName();
        $user->last_name = $request->getLastName();
        $user->save();

        return Response([]);
    }
}
