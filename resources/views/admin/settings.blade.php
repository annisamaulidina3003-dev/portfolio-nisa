@extends('admin.layout')

@section('title', 'Pengaturan')
@section('heading', 'Pengaturan')
@section('subheading', 'Kelola foto profil, informasi profil, dan akun')

@section('content')
    <div class="grid gap-6 xl:grid-cols-2">
        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <h2 class="text-lg font-black text-stone-900 dark:text-white">Foto Profil</h2>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">Foto ini tampil di beranda dan halaman CV.</p>

            <div class="mt-6 flex items-center gap-4">
                <img src="{{ asset($profilePhoto) }}" alt="Foto profil saat ini"
                    class="h-24 w-24 shrink-0 rounded-full border-4 border-emerald-100 object-cover dark:border-emerald-900" />
                <div class="min-w-0 text-sm text-stone-500 dark:text-stone-400">
                    <p class="font-bold text-stone-700 dark:text-stone-200">Foto saat ini</p>
                    <p class="mt-1">Format JPG, PNG, atau WEBP. Maksimal 4 MB.</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.photo') }}" method="POST" enctype="multipart/form-data"
                class="mt-6 grid gap-3">
                @csrf
                <input type="file" name="photo" accept="image/*" required
                    class="w-full rounded-2xl border border-stone-200 bg-white p-2.5 text-sm text-stone-600 file:mr-3 file:rounded-xl file:border-0 file:bg-emerald-600 file:px-4 file:py-2 file:text-xs file:font-bold file:text-white hover:file:bg-emerald-700 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-300" />
                @error('photo')
                    <p class="text-xs font-semibold text-rose-500">{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:from-emerald-700 hover:to-teal-700">
                    Unggah Foto
                </button>
            </form>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <h2 class="text-lg font-black text-stone-900 dark:text-white">Informasi Akun</h2>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">Akun yang sedang aktif.</p>

            <dl class="mt-6 space-y-3 text-sm">
                <div class="flex items-center justify-between gap-3 rounded-2xl bg-stone-50 px-4 py-3 dark:bg-stone-950/60">
                    <dt class="font-semibold text-stone-500 dark:text-stone-400">Nama</dt>
                    <dd class="truncate font-bold text-stone-800 dark:text-stone-100">{{ auth()->user()->name }}</dd>
                </div>
                <div class="flex items-center justify-between gap-3 rounded-2xl bg-stone-50 px-4 py-3 dark:bg-stone-950/60">
                    <dt class="font-semibold text-stone-500 dark:text-stone-400">Email</dt>
                    <dd class="truncate font-bold text-stone-800 dark:text-stone-100">{{ auth()->user()->email }}</dd>
                </div>
                <div class="flex items-center justify-between gap-3 rounded-2xl bg-stone-50 px-4 py-3 dark:bg-stone-950/60">
                    <dt class="font-semibold text-stone-500 dark:text-stone-400">Peran</dt>
                    <dd class="font-bold text-stone-800 dark:text-stone-100">Administrator</dd>
                </div>
            </dl>

            <div class="mt-5 grid gap-2 text-sm">
                <a href="{{ route('admin.content.edit') }}"
                    class="flex items-center justify-between rounded-2xl bg-stone-50 px-4 py-3 font-semibold text-stone-700 transition hover:bg-stone-100 dark:bg-stone-950/60 dark:text-stone-200 dark:hover:bg-stone-800">
                    Ubah konten CV
                    <span class="text-stone-400">&rarr;</span>
                </a>
                <a href="{{ route('cv') }}"
                    class="flex items-center justify-between rounded-2xl bg-stone-50 px-4 py-3 font-semibold text-stone-700 transition hover:bg-stone-100 dark:bg-stone-950/60 dark:text-stone-200 dark:hover:bg-stone-800">
                    Lihat CV
                    <span class="text-stone-400">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="mt-6 grid gap-6">
        @csrf
        @method('PUT')

        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <h2 class="text-lg font-black text-stone-900 dark:text-white">Informasi Profil</h2>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">Data utama yang tampil di beranda dan CV.</p>

            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Nama
                        Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $profile['name'] ?? '') }}"
                        required
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                    @error('name')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="initials" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Inisial</label>
                    <input type="text" id="initials" name="initials"
                        value="{{ old('initials', $profile['initials'] ?? '') }}" maxlength="5"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="class" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Kelas</label>
                    <input type="text" id="class" name="class" value="{{ old('class', $profile['class'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="major" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Jurusan</label>
                    <input type="text" id="major" name="major" value="{{ old('major', $profile['major'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div class="md:col-span-2">
                    <label for="tagline"
                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Tagline</label>
                    <input type="text" id="tagline" name="tagline"
                        value="{{ old('tagline', $profile['tagline'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="status"
                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Status</label>
                    <input type="text" id="status" name="status" value="{{ old('status', $profile['status'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="birth" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Tempat &
                        Tanggal Lahir</label>
                    <input type="text" id="birth" name="birth" value="{{ old('birth', $profile['birth'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="domicile" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Domisili</label>
                    <input type="text" id="domicile" name="domicile"
                        value="{{ old('domicile', $profile['domicile'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div class="md:col-span-2">
                    <label for="description"
                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Deskripsi Singkat</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('description', $profile['description'] ?? '') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="career_goal" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Tujuan
                        Karier</label>
                    <textarea id="career_goal" name="career_goal" rows="3"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('career_goal', $profile['career_goal'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <h2 class="text-lg font-black text-stone-900 dark:text-white">Informasi Kontak</h2>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">Tautan dan kontak yang tampil di portofolio.</p>

            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <div>
                    <label for="email" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $contact['email'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                    @error('email')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="whatsapp"
                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">WhatsApp</label>
                    <input type="text" id="whatsapp" name="whatsapp"
                        value="{{ old('whatsapp', $contact['whatsapp'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="whatsapp_url" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">URL
                        WhatsApp</label>
                    <input type="url" id="whatsapp_url" name="whatsapp_url"
                        value="{{ old('whatsapp_url', $contact['whatsapp_url'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                    @error('whatsapp_url')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location"
                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Lokasi</label>
                    <input type="text" id="location" name="location"
                        value="{{ old('location', $contact['location'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="github" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">URL
                        GitHub</label>
                    <input type="url" id="github" name="github"
                        value="{{ old('github', $contact['github'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                    @error('github')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="github_handle"
                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Username GitHub</label>
                    <input type="text" id="github_handle" name="github_handle"
                        value="{{ old('github_handle', $contact['github_handle'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="linkedin" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">URL
                        LinkedIn</label>
                    <input type="url" id="linkedin" name="linkedin"
                        value="{{ old('linkedin', $contact['linkedin'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                    @error('linkedin')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="linkedin_handle"
                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Username LinkedIn</label>
                    <input type="text" id="linkedin_handle" name="linkedin_handle"
                        value="{{ old('linkedin_handle', $contact['linkedin_handle'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>

                <div>
                    <label for="instagram" class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">URL
                        Instagram</label>
                    <input type="url" id="instagram" name="instagram"
                        value="{{ old('instagram', $contact['instagram'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                    @error('instagram')
                        <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instagram_handle"
                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Username Instagram</label>
                    <input type="text" id="instagram_handle" name="instagram_handle"
                        value="{{ old('instagram_handle', $contact['instagram_handle'] ?? '') }}"
                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
            <button type="submit"
                class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:from-emerald-700 hover:to-teal-700">
                Simpan Informasi
            </button>
            <a href="{{ route('home') }}"
                class="inline-flex items-center justify-center rounded-2xl bg-stone-100 px-8 py-3.5 text-sm font-bold text-stone-700 transition hover:bg-stone-200 dark:bg-stone-800 dark:text-stone-200 dark:hover:bg-stone-700">
                Lihat Hasil
            </a>
        </div>
    </form>
@endsection
