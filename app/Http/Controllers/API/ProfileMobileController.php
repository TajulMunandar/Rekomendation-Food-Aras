<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataPasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileMobileController extends Controller
{
    public function Profile(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'jk' => 'required',
                'tb' => 'required|integer',
                'bb' => 'required|integer',
                'kolesterol' => 'required|integer',
                'umur' => 'required|integer',
                'lemak' => 'required|numeric',
                'serat' => 'required|numeric',
                'protein' => 'required|numeric',
            ]);

            $userId = $request->id;

            // Update data pada tabel 'users'
            User::where('id', $userId)->update([
                'name' => $validatedData['name'],
            ]);

            // Update data pada tabel 'data_pasien'
            $dataPasien = DataPasien::where('user_id', $userId)->firstOrFail();
            $dataPasien->update([
                'jk' => $validatedData['jk'],
                'tb' => $validatedData['tb'],
                'bb' => $validatedData['bb'],
                'kolesterol' => $validatedData['kolesterol'],
                'umur' => $validatedData['umur'],
                'serat' => $validatedData['serat'],
                'protein' => $validatedData['protein'],
                'lemak' => $validatedData['lemak'],
            ]);

            return response()->json(['message' => 'Profile updated successfully'], 200);
        } catch (\Exception $e) {
            // Log error
            Log::error('Error updating profile: ' . $e->getMessage());

            // Mengembalikan response error
            return response()->json(['error' => 'Failed to update profile'], 500);
        }
    }
}
