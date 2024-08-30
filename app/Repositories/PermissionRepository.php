<?php

namespace App\Repositories;

use App\Interfaces\PermissionInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{

    public function all(): Collection
    {
        $permissions = Permission::all();
        return $permissions->load('roles');
    }

    public function create(array$request):mixed
    {
        return Permission::create($request);
    }

    public function delete(int$id): ?bool
    {
        $permission = Permission::find($id);
        return $permission->delete();
    }

    public function update(array$request, int$id): array|Permission|null
    {
        $role = Permission::find($id);
        $role->update($request);
        return $role;
    }

}