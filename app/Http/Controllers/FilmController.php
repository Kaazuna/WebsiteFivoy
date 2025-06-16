<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use App\Models\Film;
use App\Models\Genre;

class FilmController extends Controller
{
    // tampilan register 
    public function showRegister()
    {
        return view('register'); 
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ],
[
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]); 
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'password' => 'required',
        ]);

        // Cari user berdasarkan 'name' (yang kamu anggap sebagai username)
        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'login' => 'name atau password salah.',
            ]);
        }
        session(['user' => $user->only(['id','name','email','role']) ]);

        if ($user->role === 'admin'){
            return redirect()->route('get.tambah')->with('success', 'login berhasil');
        }

        return redirect()->route('dashboard');
    }

    public function showAll()
        {
            $films = Film::latest()->get();
            $genres = Genre::all();
            
            return view('films.all-films', compact('films', 'genres'));
        }

    public function logout(Request $request)
        {
            $request->session()->forget('user');
            return redirect()->route('welcome'); 
        }
 }
