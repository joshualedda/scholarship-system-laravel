<?php

namespace App\Http\Controllers\Auth;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');

    }

    public function loginAction(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            //Record audit trail for user login
            AuditLog::create([
                'user_id' => $user->id,
                'action' => 'Login',
                'data' => json_encode('Login by ' . $user->name),
            ]);
            // dd($user->name);

        // $user = Auth::user();
        return redirect()->route('dashboard');

    }
    return redirect()->back()->withErrors(['login' => 'Invalid credentials'])->withInput();
    }


    public function logout()
    {
        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Logout in the system',
            'data' => json_encode('Logout: ' . $user->name),
        ]);

        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');

    }

}
