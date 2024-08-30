<?php

namespace App\Repositories;

use App\Interfaces\CandidateInterface;
use App\Models\Candidates;
use Illuminate\Database\Eloquent\Collection;

class CandidateRepository implements CandidateInterface
{

    public function all(): Collection|string
    {
        $candidate = Candidates::all();
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
