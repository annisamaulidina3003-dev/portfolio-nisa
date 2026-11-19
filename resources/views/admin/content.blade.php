@extends('admin.layout')

@section('title', 'Konten')
@section('heading', 'Konten')
@section('subheading', 'Ubah isi CV dan portofolio tanpa menyentuh kode')

@section('content')
    <form action="{{ route('admin.content.update') }}" method="POST" class="grid gap-6">
        @csrf
        @method('PUT')

        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <h2 class="text-lg font-black text-stone-900 dark:text-white">Ringkasan CV</h2>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">Paragraf profil singkat yang tampil di halaman CV.
            </p>

            <textarea name="cv_summary" rows="4"
                class="mt-4 w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('cv_summary', $cvSummary) }}</textarea>
            @error('cv_summary')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <h2 class="text-lg font-black text-stone-900 dark:text-white">Pendidikan</h2>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">
                Satu baris per pendidikan dengan format:
                <code class="rounded bg-stone-100 px-1.5 py-0.5 text-xs dark:bg-stone-800">periode | sekolah | keterangan</code>
            </p>

            <textarea name="education" rows="6"
                class="mt-4 w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 font-mono text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('education', $education) }}</textarea>
            @error('education')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <h2 class="text-lg font-black text-stone-900 dark:text-white">Pengalaman</h2>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">
                Satu baris per pengalaman dengan format:
                <code class="rounded bg-stone-100 px-1.5 py-0.5 text-xs dark:bg-stone-800">periode | judul | tempat | deskripsi</code>
            </p>

            <textarea name="experiences" rows="8"
                class="mt-4 w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 font-mono text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('experiences', $experiences) }}</textarea>
            @error('experiences')
                <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-6 xl:grid-cols-2">
            <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
                <h2 class="text-lg font-black text-stone-900 dark:text-white">Hard Skills</h2>
                <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">
                    Format: <code class="rounded bg-stone-100 px-1.5 py-0.5 text-xs dark:bg-stone-800">nama | level (0-100)</code>
                </p>

                <textarea name="hard_skills" rows="8"
                    class="mt-4 w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 font-mono text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('hard_skills', $hardSkills) }}</textarea>
                @error('hard_skills')
                    <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
                <h2 class="text-lg font-black text-stone-900 dark:text-white">Soft Skills</h2>
                <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">
                    Format: <code class="rounded bg-stone-100 px-1.5 py-0.5 text-xs dark:bg-stone-800">nama | level (0-100)</code>
                </p>

                <textarea name="soft_skills" rows="8"
                    class="mt-4 w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 font-mono text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('soft_skills', $softSkills) }}</textarea>
                @error('soft_skills')
                    <p class="mt-1.5 text-xs font-semibold text-rose-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
            <button type="submit"
                class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:from-emerald-700 hover:to-teal-700">
                Simpan Konten
            </button>
            <a href="{{ route('home') }}"
                class="inline-flex items-center justify-center rounded-2xl bg-stone-100 px-8 py-3.5 text-sm font-bold text-stone-700 transition hover:bg-stone-200 dark:bg-stone-800 dark:text-stone-200 dark:hover:bg-stone-700">
                Lihat Hasil
            </a>
        </div>
    </form>
@endsection
