<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// Log fasadini import qilish

class CandidatesController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'birthday' => 'required',
                'telegram_id' => 'required|integer',
                'full_name' => 'required|string',
                'phone_number' => 'required|string',
                'address' => 'nullable|string',
                'is_student' => 'nullable|string',
                'gender' => 'nullable|string',
                'university_place' => 'nullable|string',
                'marital_state' => 'nullable|string',
                'last_work' => 'nullable|string',
                'languages' => 'nullable|string',
                'positive_skills' => 'nullable|string',
                'apps' => 'nullable|string',
                'voice_path' => 'nullable|file|mimes:ogg,mp3,wav',
                'photo_path' => 'nullable|file|mimes:jpg,jpeg,png'
            ]);

            // Fayllarni saqlash
            if ($request->hasFile('voice_path')) {
                $validatedData['voice_path'] = $request->file('voice_path')->store('Candidates/voices');
            }

            if ($request->hasFile('photo_path')) {
                $validatedData['photo_path'] = $request->file('photo_path')->store('Candidates/photos');
            }
            $language_id = str_replace(',', '', $validatedData['languages']);
            $app_id = str_replace(',', '', $validatedData['apps']);

            // Kandidat yaratish
            $candidate = Candidates::create([
                'telegram_id' => $validatedData['telegram_id'],
                'full_name' => $validatedData['full_name'],
                'phone_number' => $validatedData['phone_number'],
                'address' => $validatedData['address'],
                'birthday' => $validatedData['birthday'],
                'is_student' => $validatedData['is_student'],
                'gender' => $validatedData['gender'],
                'university_place' => $validatedData['university_place'],
                'marital_state' => $validatedData['marital_state'],
                'last_work' => $validatedData['last_work'],
                'language_id' => $language_id,
                'positive_skills' => $validatedData['positive_skills'],
                'app_id' => $app_id,
                'voice_path' => $validatedData['voice_path'] ?? null,
                'photo_path' => $validatedData['photo_path'] ?? null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Candidate successfully created.',
                'data' => $candidate
            ], 201);

        } catch (\Exception $e) {
            // Xatolikni logga yozish
            Log::error('Xatolik yuz berdi: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Xatolikni foydalanuvchiga qaytarish
            return response()->json([
                'success' => false,
                'message' => 'Candidate creation failed. Please try again later.'
            ], 500);
        }
    }
}
