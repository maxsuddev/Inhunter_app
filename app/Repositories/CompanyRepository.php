<?php

namespace App\Repositories;

use App\Interfaces\CompanyInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyInterface
{

    public function all(): Collection|string
    {
        $candidate = Company::all();
        if($candidate->isEmpty()){
            return "No Company Found";
        }

        return $candidate;
    }


    public function create(array $request)
    {
        return Company::create($request);

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
