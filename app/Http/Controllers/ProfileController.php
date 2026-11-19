<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $directory = public_path('image');

        foreach (File::glob($directory.'/profile-photo.*') as $existingPhoto) {
            File::delete($existingPhoto);
        }

        $extension = $request->file('photo')->extension();
        $request->file('photo')->move($directory, 'profile-photo.'.$extension);

        return redirect()
            ->to(route('home').'#foto')
            ->with('success', 'Foto profil berhasil diperbarui.');
    }
}
