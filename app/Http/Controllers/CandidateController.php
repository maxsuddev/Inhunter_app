<?php

namespace App\Http\Controllers;

use App\Interfaces\CandidateInterface;
use App\Models\Candidates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CandidateController extends Controller
{
    protected CandidateInterface $candidate;

    public function __construct(CandidateInterface $candidateRepository)
    {
        $this->candidate = $candidateRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $candidates = $this->candidate->all();

            $errorMessage = null;
            if(is_string($candidates)) {
                $errorMessage = $candidates;
            }
            return view('candidate.index', compact('candidates', 'errorMessage'));
        }catch (\Exception $e){
            Log::error(message: 'Hech qanday nomzod topilmadi:' .' '. $e->getMessage() .' '. 'Xato qatori'.' ' . $e->getLine());
            return  redirect()->route('candidate.index')->with('error', 'No se han encontrado nomzod!');
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
        //
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
