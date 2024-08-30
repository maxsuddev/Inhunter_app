<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
//        dd($request->all());
        try {
            if (!auth('web')->attempt(['email' => $request->email, 'password' => $request->password]))
            {
                return redirect()->back()->withErrors(['error' => 'Email atau password salah!']);
            }

            return redirect()->route('dashboard')->with(['success' => 'Berhasil login!']);
        }
        catch (\Exception $e)
        {
            Log::error(message: 'Foydalanuvchi muvaffaqiyatli tizimga kira olmadi:' . $e->getMessage() . 'Xato qatori' .  ' ' . $e->getLine());
            return redirect()->back()->withErrors(['email' => 'Email atau password salah!']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }



}
