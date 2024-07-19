<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:5'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'jk' => ['required'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = "user";

        $user = User::create($validatedData);

        if ($user) {
            return redirect()->route('login.index')->with('success', 'Register Berhasil!');
        } else {
            // Jika pembuatan pengguna gagal
            return redirect()->route('register.index')->with('failed', 'Register Tidak Berhasil!');;
        }
    }
}
