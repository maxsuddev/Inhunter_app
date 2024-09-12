<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRequest;
use App\Models\Candidates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CandidatesController extends Controller
{
    public function store(CandidateRequest $request)
    {
        try {
            $validatedData = $request->validate([
                'telegram_id' => 'required|integer',
            ]);
            if ($request->hasFile('voice_path')) {
                $file = $request->file('voice_path');
                $fileName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $validatedData['voice_path'] = $file->storeAs('Candidates/voices', $fileName);
            }

            if ($request->hasFile('photo_path')) {
                $file = $request->file('photo_path');
                $fileName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                $validatedData['photo_path'] = $file->storeAs('Candidates/photos', $fileName);
            }

            $language_id = str_replace(',', '', $request['languages']);
            $app_id = str_replace(',', '', $request['apps']);

            $candidate = Candidates::create([
                'telegram_id' => $validatedData['telegram_id'],
                'full_name' => $request['full_name'],
                'phone_number' => $request['phone_number'],
                'address' => $request['address'],
                'birthday' => $request['birthday'],
                'is_student' => $request['is_student'],
                'gender' => $request['gender'],
                'university_place' => $request['university_place'],
                'marital_state' => $request['marital_state'],
                'last_work' => $request['last_work'],
                'language_id' => $language_id,
                'positive_skills' => $request['positive_skills'],
                'app_id' => $app_id,
                'voice_path' => $request['voice_path'] ?? null,
                'photo_path' => $request['photo_path'] ?? null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Candidate successfully created.',
                'data' => $candidate
            ], 201);

        } catch (\Exception $e) {
            Log::error('Xatolik yuz berdi: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Candidate creation failed. Please try again later.'
            ], 500);
        }
    }
}
