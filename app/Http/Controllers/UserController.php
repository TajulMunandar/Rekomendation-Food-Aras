<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Users";
        $users = User::all();
        return view('user.index')->with(compact('title', 'users'));
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
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'username' => ['required', 'max:16', 'unique:users'],
                'password' => 'required|max:255',
                'role' => 'required',
                'jk' => 'required'
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);

            return redirect('/dashboard/users')->with('success', 'User baru berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect('/dashboard/users')->with('error', 'Terjadi kesalahan saat membuat user: ' . $e->getMessage());
        }
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
    public function update(Request $request, User $user)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
                'role' => 'required',
                'jk' => 'required',
            ];

            if ($request->username != $user->username) {
                $rules['username'] = ['required', 'max:16', 'unique:users'];
            }

            $validatedData = $request->validate($rules);

            User::where('id', $user->id)->update($validatedData);

            return redirect('/dashboard/users')->with('success', 'User berhasil diperbaharui!');
        } catch (\Exception $e) {
            return redirect('/dashboard/users')->with('error', 'Terjadi kesalahan saat memperbaharui user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            User::destroy($user->id);
            return redirect('/dashboard/users')->with('success', "User $user->name berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/users')->with('failed', "User $user->name tidak bisa dihapus karena sedang digunakan!");
        }
    }

    public function reset(Request $request)
    {
        try {
            $rules = [
                'password' => 'required|max:255',
            ];

            if ($request->password == $request->password2) {
                $validatedData = $request->validate($rules);
                $validatedData['password'] = Hash::make($validatedData['password']);

                User::where('id', $request->id)->update($validatedData);

                return redirect('/dashboard/users')->with('success', 'Password berhasil direset!');
            } else {
                return back()->with('failed', 'Konfirmasi password tidak sesuai');
            }
        } catch (\Exception $e) {
            return redirect('/dashboard/users')->with('error', 'Terjadi kesalahan saat mereset password: ' . $e->getMessage());
        }
    }
}
