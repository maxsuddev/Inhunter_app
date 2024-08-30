<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserInterface
{

    public function all(): Collection|string
    {
        $user = User::all();
        if($user->isEmpty()){
            return "No User Found";
        }

        return $user;
    }

    public function create(array $request)
    {
        return User::create($request);
    }

    public function update(array $request, int $id): array|User|null
    {
        $user = User::find($id);
        $user->update($request);
        return $user;
    }

    public function delete(int $id): array|User|null
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }
}
