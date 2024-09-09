<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest;
use App\Interfaces\CandidateInterface;
use App\Models\App;
use App\Models\Candidates;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CandidateController extends Controller
{
    protected CandidateInterface $candidateRepository;

    public function __construct(CandidateInterface $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $candidates = $this->candidateRepository->all();
            $status = $request->input('status', 'new');

            $filtrCandidates = $candidates->filter(function ($candidate) use ($status) {
                return $candidate->status === $status;
            });

            $errorMessage = null;
            if (is_string($candidates)) {
                $errorMessage = $candidates;
            }
            return view('candidate.index', compact('filtrCandidates', 'errorMessage'));
        } catch (\Exception $e) {
            Log::error(message: 'Hech qanday nomzod topilmadi:' . ' ' . $e->getMessage() . ' ' . 'Xato qatori' . ' ' . $e->getLine());
            return  redirect()->route('candidate.index')->with('error', 'No se han encontrado nomzod!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();
        $apps = App::all();
        $maritalStates = Candidates::getMaritalStates();
        $gender = Candidates::getGenderOptions();


        return view('candidate.create', compact('languages', 'apps', 'maritalStates', 'gender'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CandidateRequest $request)
    {
        try {
            $this->candidateRepository->create($request->all());
            return redirect()->route('candidate.index')->with('success', 'Candidate created successfully!');
        } catch (\Exception $e) {
            Log::error('Hech qanday candidate qoshilmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No added data! Place try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidates $candidate)
    {
        return view('candidate.show', compact('candidate'));
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
}
