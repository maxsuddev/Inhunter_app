<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{

    public function all(): Collection|string
    {
        $user = Role::all();
        if($user->isEmpty()){
            return "No User Found";
        }

        return $user;
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function create(array $request): mixed
    {
        return Role::create($request);
    }

    /**
     * @param int $id
     * @param array $request
     * @return array|null|Role
     */
    public function update(array $request, int $id,): Role|array|null
    {
        $role = Role::findOrFail($id);
        $role->update($request);
        return $role;

    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $role = Role::findOrFail($id);
        return $role->delete();
    }
}
