<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected UserInterface $userRepository;
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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

        $vacancies = Vacancy::where('user_id', $user->id)
                            ->where('state', $state)
                            ->get();

        return view('user.show', compact('user', 'vacancies'));
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
