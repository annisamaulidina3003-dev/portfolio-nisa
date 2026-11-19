<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $profilePhotoFiles = glob(public_path('image/profile-photo.*')) ?: [];
        $profilePhoto = $profilePhotoFiles
            ? 'image/'.basename($profilePhotoFiles[0])
            : config('portfolio.profile.photo');

        return view('admin.settings', [
            'profilePhoto' => $profilePhoto,
            'profile' => config('portfolio.profile'),
            'contact' => config('portfolio.contact'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'initials' => ['nullable', 'string', 'max:5'],
            'class' => ['nullable', 'string', 'max:50'],
            'major' => ['nullable', 'string', 'max:150'],
            'tagline' => ['nullable', 'string', 'max:150'],
            'status' => ['nullable', 'string', 'max:100'],
            'birth' => ['nullable', 'string', 'max:100'],
            'domicile' => ['nullable', 'string', 'max:100'],
            'career_goal' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:1000'],
            'email' => ['nullable', 'email', 'max:150'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'whatsapp_url' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'github_handle' => ['nullable', 'string', 'max:100'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'linkedin_handle' => ['nullable', 'string', 'max:100'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'instagram_handle' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:150'],
        ]);

        $profile = array_filter([
            'name' => $validated['name'],
            'initials' => $validated['initials'] ?? null,
            'class' => $validated['class'] ?? null,
            'major' => $validated['major'] ?? null,
            'tagline' => $validated['tagline'] ?? null,
            'status' => $validated['status'] ?? null,
            'birth' => $validated['birth'] ?? null,
            'domicile' => $validated['domicile'] ?? null,
            'career_goal' => $validated['career_goal'] ?? null,
            'description' => $validated['description'] ?? null,
        ], fn ($value) => $value !== null);

        $contact = array_filter([
            'email' => $validated['email'] ?? null,
            'whatsapp' => $validated['whatsapp'] ?? null,
            'whatsapp_url' => $validated['whatsapp_url'] ?? null,
            'github' => $validated['github'] ?? null,
            'github_handle' => $validated['github_handle'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'linkedin_handle' => $validated['linkedin_handle'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'instagram_handle' => $validated['instagram_handle'] ?? null,
            'location' => $validated['location'] ?? null,
        ], fn ($value) => $value !== null);

        Setting::setValue('profile', $profile);
        Setting::setValue('contact', $contact);

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Informasi profil berhasil diperbarui.');
    }

    public function updatePhoto(Request $request): RedirectResponse
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
            ->route('admin.settings.edit')
            ->with('success', 'Foto profil berhasil diperbarui.');
    }
}
