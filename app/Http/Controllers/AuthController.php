<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;


class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    // public function registration(): View
    // {
    //     return view('auth.registration');
    // }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        alert()->error('Opps!', 'Email atau Password salah');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        // session()->flush();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // public function postRegistration(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);

    //     $data = $request->all();
    //     $check = $this->create($data);

    //     return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    // }

    // public function dashboard()
    // {
    //     if (Auth::check()) {
    //         return view('dashboard.sales');
    //     }

    //     return redirect("login")->withSuccess('Opps! You do not have access');
    // }

    // public function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password'])
    //     ]);
    // }

    // public function log()
    // {
    //     $activities = Activity::join('users', 'users.id', '=', 'activity_log.causer_id')
    //         ->select('activity_log.*', 'users.nama')
    //         ->orderBy('activity_log.id', 'desc')
    //         ->limit(50)
    //         ->get();
        
    //     // dd($notabelis);
    //     return view('logaktivitas.index3', compact('activities'));
    // }
}
