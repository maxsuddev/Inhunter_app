<?php

namespace App\Repositories;

use App\Interfaces\VacancyInterface;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;

class VacancyRepository implements VacancyInterface
{

    public function all(): Collection|string
    {
        $candidate = Vacancy::all();
        if($candidate->isEmpty()){
            return "No User Found";
        }

        return $candidate;
    }


    public function create(array $request)
    {
        // TODO: Implement addPermission() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement deletePermission() method.
    }

    public function update(array $request, int $id)
    {
        // TODO: Implement updatePermission() method.
    }
}
