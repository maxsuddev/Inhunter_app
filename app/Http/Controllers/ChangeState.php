<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\User;
use App\Models\Vacancy;
use App\Services\CandidateService;
use App\Services\VacancyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChangeState extends Controller
{

    protected CandidateService $candidateService;
    protected VacancyService $vacancyService;

    public function __construct( CandidateService $candidateService, VacancyService $vacancyService )
    {
        $this->candidateService = $candidateService;
        $this->vacancyService = $vacancyService;
    }

    /** function bind candidate to user
     * @param Candidates $candidate
     * @return RedirectResponse
     */
    public function changeStateCandidate(Candidates $candidate)
    {   $newState = 'working';
        $this->candidateService->updateStatisticsOnCAndidateUpdate(candidateId: $candidate->id, newState: $newState, previousState: $candidate->status);
        $candidate->user_id = Auth::id();
        $candidate->status = $newState;
        $candidate->save();

        return redirect()->back()->with('success', 'Candidate state changed to working_vacancy.');
    }

    /** function bind vacancy to user
     * @param Vacancy $vacancy
     * @return RedirectResponse
     */
    public function changeStateVacancy(Vacancy $vacancy)
    {   $newState = 'working_vacancy';
        $this->vacancyService->updateStatisticsOnVacancyUpdate( vacancyId: $vacancy->id, newState:  $newState, previousState:  $vacancy->state);
        $vacancy->user_id = Auth::id();
        $vacancy->state = $newState;
        $vacancy->save();

        return redirect()->back()->with('success', 'Vacancy state changed to working_vacancy.');
    }



    public function updateStateVacancy(Request $request, User $user)
    {
        if ($request->input('bind_candidate') === 'bind_candidate') {
            $archivedCandidates = Candidates::where('user_id', $user->id)
                ->where('status', 'archive')
                ->get();
            return redirect()->back()->with([
                'success' => 'You may choose candidate from archive.',
                'archivedCandidates' => $archivedCandidates,
                'vacancy_id' => $request->input('vacancy_id')
            ]);
        }


            $request->validate([
                'state' => 'required|in:open_vacancy,working_vacancy,close_vacancy,cancel_vacancy',
                'vacancy_id' => 'required|exists:vacancies,id',
            ]);

            try {

                $vacancy = Vacancy::where('user_id', $user->id)
                    ->where('id', $request->input('vacancy_id'))
                    ->firstOrFail();

                $newState = $request->input('state');

                $this->vacancyService->updateStatisticsOnVacancyUpdate($vacancy->id, $newState, $vacancy->state);


                $vacancy->state = $newState;
                $vacancy->closed_at = now();
                $vacancy->save();


                return redirect()->back()->with('success', 'Vacancy state successfully updated.');

            } catch (\Exception $e) {
                Log::error('Error updating vacancy state: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while updating the vacancy state.');
            }
        }





    public function assignCandidate(Request $request, User $user)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'vacancy_id' => 'required|exists:vacancies,id',
        ]);
        Log::info('Request vacancy_id: ' . $request->input('vacancy_id'));

        $candidate_id = $request->input('candidate_id');

        try {
            $vacancy = Vacancy::where('user_id', $user->id)
                ->where('id', $request->input('vacancy_id'))
                ->firstOrFail();
            $candidate = Candidates::where('id', $candidate_id)->firstOrFail();

            $vacancy->candidate_id = $candidate_id;
            $vacancy->save();

            $previousState = $candidate->status;
            $newState = 'hired';
            $candidate->status = $newState;
            $candidate->save();

            $this->candidateService->updateStatisticsOnCandidateUpdate($candidate->id, $newState, $previousState);
            return redirect()->back()->with('success', 'The candidate vacancy has been achieved.');

        } catch (\Exception $e) {
            Log::error('Nomzodni biriktirishda xatolik: ' . $e->getMessage());
            return redirect()->back()->with('error', 'The candidate vacancy has been achieved.');
        }
    }

}
