<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Models\Candidates;
use App\Models\User;
use App\Models\Vacancy;
use App\Services\CandidateService;
use App\Services\VacancyService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected UserInterface $userRepository;
    protected CandidateService $candidateService;
    protected VacancyService $vacancyService;
    public function __construct(UserInterface $userRepository, CandidateService $candidateService, VacancyService $vacancyService)
    {
        $this->userRepository = $userRepository;
        $this->candidateService = $candidateService;
        $this->vacancyService = $vacancyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = $this->userRepository->all();

            $errorMessage = null;
            if (is_string($users)) {
                $errorMessage = $users;
            }
            return view('user.index', compact('users', 'errorMessage'));
        } catch (\Exception $e) {
            Log::error(message: 'Hech qanday role topilmadi:' . ' ' . $e->getMessage() . ' ' . 'Xato qatori' . ' ' . $e->getLine());
            return  redirect()->route('role.index')->with('error', 'No se han encontrado roles!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->all();
        return redirect()->route('user')->with('user', $user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Request $request) {
        $user = User::findOrFail($user->id);
        $state = $request->input('state', 'working_vacancy');
        $status = $request->input('status', 'working');

        $vacancies = Vacancy::where('user_id', $user->id)
            ->where('state', $state)
            ->get();

        $candidates = Candidates::where('user_id', $user->id)
            ->where('status', $status)
            ->get();



        return view('user.show', compact('user', 'vacancies', 'candidates'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**  function redirect to user's vacancy page
     * @param User $user
     * @param Request $request
     * @return Factory|View|Application|\Illuminate\View\View
     */

    public function  user_vacancies(User $user, Request $request)
    {
        $user = User::findOrFail($user->id);
        $state = $request->input('state', 'working_vacancy');

        $vacancies = Vacancy::where('user_id', $user->id)
            ->where('state', $state)
            ->get();

        return view('user.user_vacancy', compact('user', 'vacancies'));
    }

    /** function redirect to user's candidate page
     * @param User $user
     * @param Request $request
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function  user_candidate(User $user, Request $request)
    {
        $user = User::findOrFail($user->id);
        $status = $request->input('state', 'working');

        $candidates = Candidates::where('user_id', $user->id)
            ->where('status', $status)
            ->get();
        return view('user.user_candidate', compact('user', 'candidates'));

    }






    /** function change candidate state
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function updateStatusCandidate(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:new,working,interview,archive,hired',
            'candidate_id' => 'required|exists:candidates,id'
        ]);
        $newState = $request->input('status');
        try {
            $candidate = Candidates::where('user_id', $user->id)
                ->where('id', $request->input('candidate_id'))
                ->firstOrFail();
            //statistic service
            $this->candidateService->updateStatisticsOnCandidateUpdate(candidateId: $candidate->id, newState: $newState, previousState: $candidate->status);

            $candidate->status = $newState;
            $candidate->save();

            return redirect()->back()->with('success', 'Candidate state changed to {$newState}.');
        }catch (\Exception $e) {
            Log::error('Candidate statusni yangilashda xatolik: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Candidate statusni yangilashda xatolik');
        }
    }









}
