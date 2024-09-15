<?php

namespace App\Repositories;

use App\Interfaces\CandidateInterface;
use App\Models\Candidates;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Candidates_C;

class CandidateRepository implements CandidateInterface
{

    public function all(): Collection|string
    {
        $candidate = Candidates::all();
        if ($candidate->isEmpty()) {
            return "No User Found";
        }

        return $candidate;
    }


    public function create(array $request)
    {
        return  Candidates::create([
            'phone_number' => $request['phone_number'],
            'full_name' => $request['full_name'],
            'address' => $request['address'],
            'birthday' => $request['birthday'],
            'is_student' => $request['is_student'],
            'gender' => $request['gender'],
            'university_place' => $request['university_place'],
            'marital_state' => $request['marital_state'],
            'last_work' => $request['last_work'],
            'language_id' => $request['language_id'],
            'positive_skills' => $request['positive_skills'],
            'app_id' => $request['app_id'],
            'status' => $request['status']
        ]);
    }

    public function delete(int $id)
    {
        // TODO: Implement deletePermission() method.
    }

    public function update(array $request, int $id): Candidates|_IH_Candidates_C|array|null
    {
        $candidate = Candidates::findOrFail($id);

            $candidate->update([
                'phone_number' => $request['phone_number'],
                'full_name' => $request['full_name'],
                'address' => $request['address'],
                'birthday' => $request['birthday'],
                'is_student' => $request['is_student'],
                'gender' => $request['gender'],
                'university_place' => $request['university_place'],
                'marital_state' => $request['marital_state'],
                'last_work' => $request['last_work'],
                'language_id' => $request['language_id'],
                'positive_skills' => $request['positive_skills'],
                'app_id' => $request['app_id'],
                'status' => $request['status'] ?? '',
            ]);
        return $candidate;
    }
}
