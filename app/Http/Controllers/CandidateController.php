<?php

namespace App\Http\Controllers;

use App\Interfaces\CandidateInterface;
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
            $users = $this->userRepository->all();

            $errorMessage = null;
            if(is_string($users)) {
                $errorMessage = $users;
            }
            return view('user.index', compact('users', 'errorMessage'));
        }catch (\Exception $e){
            Log::error(message: 'Hech qanday role topilmadi:' .' '. $e->getMessage() .' '. 'Xato qatori'.' ' . $e->getLine());
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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