<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataPasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

class AuthMobileController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data = DataPasien::where('user_id', $user->id)->first();

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['access_token' => $token, 'user_profile' => $user, 'data' => $data], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        try {
            // Validate request inputs
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:users,username|max:255',
                'password' => 'required|string',
                'role' => 'required|string|in:user,admin',
                'jk' => 'required|string|in:laki-laki,perempuan',
                'aktivitas_id' => 'required|integer',
                'tb' => 'required|numeric',
                'bb' => 'required|numeric',
                'kolesterol' => 'required|numeric',
                'umur' => 'required|integer',
            ]);

            // Create new user
            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'role' => $validatedData['role'],
                'jk' => $validatedData['jk'],
            ]);

            // Optionally, create associated DataPasien record
            $dataPasien = DataPasien::create([
                'user_id' => $user->id,
                'aktivitas_id' => $validatedData['aktivitas_id'],
                'tb' => $validatedData['tb'],
                'bb' => $validatedData['bb'],
                'kolesterol' => $validatedData['kolesterol'],
                'umur' => $validatedData['umur'],
            ]);

            // Generate token
            $token = $user->createToken('authToken')->plainTextToken;

            // Return response with token and user data
            return response()->json(['access_token' => $token, 'user_profile' => $user, 'data' => $dataPasien], 201);
        } catch (ValidationException $e) {
            Log::error('Registration validation failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Validation error'], 422);
        } catch (\Exception $e) {
            Log::error('An error occurred during registration', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
}
