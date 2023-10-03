<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import class Storage

class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        $userInfo = UserInfo::where('user_id', $user->id)->first(); // Mendapatkan data UserInfo sesuai user_id

        return view('user.profil', compact('user', 'userInfo'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login

        // Validation rules for form fields
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'image|mimes:jpeg,png,jpg|max:100', // Image validation
        ];

    
        $request->validate($rules);

        // Update user data
        $user->name = $request->input('name');
        $user->email = $request->input('email');

      
        $user->save();

        // Memperbarui data position dan image pada tabel user_info
        if ($request->has('position') || $request->has('image')) {
            $userInfo = UserInfo::updateOrCreate(
                ['user_id' => $user->id], // Kriteria pencarian berdasarkan user_id
                [
                    'user_id' => $user->id,
                    'position' => $request->input('position'),
                    // 'image' => $request->input('image'),
                ]
            );

            // Memeriksa apakah ada file gambar yang diunggah
            if ($request->file('image')) {
                if ($userInfo->image) {
                    Storage::delete('public/' . $userInfo->image); // Hapus foto lama
                }
                $imagePath = $request->file('image')->store('user_images', 'public');
                $userInfo->image = $imagePath;
                $userInfo->save();
            }
        }

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.' . $request->input('password'));
    }
}
