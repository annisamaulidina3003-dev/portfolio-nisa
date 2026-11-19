@extends('admin.layout')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('subheading', 'Ringkasan konten dan aktivitas terbaru')

@section('content')
    <div
        class="rounded-3xl border border-stone-200 bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700 p-6 text-white shadow-lg shadow-emerald-500/20 lg:p-8">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-emerald-50/80">Selamat datang kembali,</p>
                <h1 class="mt-1 text-2xl font-black lg:text-3xl">{{ auth()->user()->name }}</h1>
                <p class="mt-2 max-w-xl text-sm text-emerald-50/90">Kelola project, pesan masuk, dan foto profil
                    portofolio kamu dari satu tempat.</p>
            </div>
            <a href="{{ route('admin.projects.create') }}"
                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-bold text-emerald-700 shadow-sm transition hover:bg-emerald-50">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Project
            </a>
        </div>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl border border-stone-200 bg-white p-5 shadow-sm dark:border-stone-800 dark:bg-stone-900">
            <div class="flex items-center justify-between">
                <span
                    class="grid h-11 w-11 place-items-center rounded-2xl bg-emerald-100 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-400">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                </span>
                <span class="text-3xl font-black text-stone-900 dark:text-white">{{ $stats['projects'] }}</span>
            </div>
            <p class="mt-4 text-sm font-bold text-stone-700 dark:text-stone-200">Total Project</p>
            <a href="{{ route('admin.projects.index') }}"
                class="mt-1 inline-block text-xs font-semibold text-emerald-600 hover:underline dark:text-emerald-400">Kelola
                project</a>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white p-5 shadow-sm dark:border-stone-800 dark:bg-stone-900">
            <div class="flex items-center justify-between">
                <span
                    class="grid h-11 w-11 place-items-center rounded-2xl bg-teal-100 text-teal-600 dark:bg-teal-950/60 dark:text-teal-400">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.613a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </span>
                <span class="text-3xl font-black text-stone-900 dark:text-white">{{ $stats['messages'] }}</span>
            </div>
            <p class="mt-4 text-sm font-bold text-stone-700 dark:text-stone-200">Pesan Masuk</p>
            <a href="{{ route('admin.messages.index') }}"
                class="mt-1 inline-block text-xs font-semibold text-emerald-600 hover:underline dark:text-emerald-400">Lihat
                pesan</a>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white p-5 shadow-sm dark:border-stone-800 dark:bg-stone-900">
            <div class="flex items-center justify-between">
                <span
                    class="grid h-11 w-11 place-items-center rounded-2xl bg-amber-100 text-amber-600 dark:bg-amber-950/60 dark:text-amber-400">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <span class="text-3xl font-black text-stone-900 dark:text-white">{{ $stats['certificates'] }}</span>
            </div>
            <p class="mt-4 text-sm font-bold text-stone-700 dark:text-stone-200">Sertifikat</p>
            <a href="{{ route('admin.certificates.index') }}"
                class="mt-1 inline-block text-xs font-semibold text-emerald-600 hover:underline dark:text-emerald-400">Kelola
                sertifikat</a>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white p-5 shadow-sm dark:border-stone-800 dark:bg-stone-900">
            <div class="flex items-center justify-between">
                <span
                    class="grid h-11 w-11 place-items-center rounded-2xl bg-cyan-100 text-cyan-600 dark:bg-cyan-950/60 dark:text-cyan-400">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </span>
                <span class="text-3xl font-black text-stone-900 dark:text-white">{{ $stats['experiences'] }}</span>
            </div>
            <p class="mt-4 text-sm font-bold text-stone-700 dark:text-stone-200">Pengalaman</p>
            <a href="{{ route('admin.content.edit') }}"
                class="mt-1 inline-block text-xs font-semibold text-emerald-600 hover:underline dark:text-emerald-400">Kelola
                konten</a>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-2">
        <div class="rounded-3xl border border-stone-200 bg-white shadow-sm dark:border-stone-800 dark:bg-stone-900">
            <div class="flex items-center justify-between border-b border-stone-200 px-5 py-4 dark:border-stone-800">
                <h2 class="text-sm font-black uppercase tracking-wider text-stone-700 dark:text-stone-200">Project Terbaru
                </h2>
                <a href="{{ route('admin.projects.index') }}"
                    class="text-xs font-bold text-emerald-600 hover:underline dark:text-emerald-400">Semua</a>
            </div>

            <div class="divide-y divide-stone-100 dark:divide-stone-800">
                @forelse ($recentProjects as $project)
                    <div class="flex items-center gap-3 px-5 py-4">
                        <div
                            class="h-12 w-16 shrink-0 overflow-hidden rounded-xl bg-stone-200 dark:bg-stone-800">
                            @if ($project->image_data_url)
                                <img src="{{ $project->image_data_url }}" alt="{{ $project->title }}"
                                    class="h-full w-full object-cover" />
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-bold text-stone-800 dark:text-stone-100">
                                {{ $project->title }}</p>
                            <p class="truncate text-xs text-stone-500 dark:text-stone-400">
                                {{ $project->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                        <a href="{{ route('admin.projects.edit', $project) }}"
                            class="shrink-0 rounded-lg bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-700 transition hover:bg-amber-200 dark:bg-amber-950/60 dark:text-amber-300">Edit</a>
                    </div>
                @empty
                    <p class="px-5 py-10 text-center text-sm text-stone-500 dark:text-stone-400">Belum ada project.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white shadow-sm dark:border-stone-800 dark:bg-stone-900">
            <div class="flex items-center justify-between border-b border-stone-200 px-5 py-4 dark:border-stone-800">
                <h2 class="text-sm font-black uppercase tracking-wider text-stone-700 dark:text-stone-200">Pesan Terbaru
                </h2>
                <a href="{{ route('admin.messages.index') }}"
                    class="text-xs font-bold text-emerald-600 hover:underline dark:text-emerald-400">Semua</a>
            </div>

            <div class="divide-y divide-stone-100 dark:divide-stone-800">
                @forelse ($recentMessages as $message)
                    <a href="{{ route('admin.messages.show', $message) }}"
                        class="flex items-start gap-3 px-5 py-4 transition hover:bg-stone-50 dark:hover:bg-stone-800/60">
                        <span
                            class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-teal-100 text-xs font-black text-teal-700 dark:bg-teal-950/60 dark:text-teal-300">
                            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($message->name, 0, 1)) }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-2">
                                <p class="truncate text-sm font-bold text-stone-800 dark:text-stone-100">
                                    {{ $message->name }}</p>
                                <span class="shrink-0 text-xs text-stone-400">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="truncate text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ $message->category }}</p>
                            <p class="mt-1 line-clamp-1 text-xs text-stone-500 dark:text-stone-400">
                                {{ $message->message }}</p>
                        </div>
                    </a>
                @empty
                    <p class="px-5 py-10 text-center text-sm text-stone-500 dark:text-stone-400">Belum ada pesan masuk.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <a href="{{ route('admin.projects.create') }}"
            class="group rounded-2xl border border-stone-200 bg-white p-4 transition hover:border-emerald-300 dark:border-stone-800 dark:bg-stone-900 dark:hover:border-emerald-700">
            <p class="text-sm font-bold text-stone-800 dark:text-stone-100">Tambah project</p>
            <p class="mt-1 text-xs text-stone-500 dark:text-stone-400">Unggah karya baru ke galeri.</p>
        </a>
        <a href="{{ route('admin.certificates.create') }}"
            class="group rounded-2xl border border-stone-200 bg-white p-4 transition hover:border-emerald-300 dark:border-stone-800 dark:bg-stone-900 dark:hover:border-emerald-700">
            <p class="text-sm font-bold text-stone-800 dark:text-stone-100">Tambah sertifikat</p>
            <p class="mt-1 text-xs text-stone-500 dark:text-stone-400">Catat sertifikat atau prestasi baru.</p>
        </a>
        <a href="{{ route('admin.content.edit') }}"
            class="group rounded-2xl border border-stone-200 bg-white p-4 transition hover:border-emerald-300 dark:border-stone-800 dark:bg-stone-900 dark:hover:border-emerald-700">
            <p class="text-sm font-bold text-stone-800 dark:text-stone-100">Edit konten CV</p>
            <p class="mt-1 text-xs text-stone-500 dark:text-stone-400">Perbarui ringkasan, pendidikan, dan skill.</p>
        </a>
        <a href="{{ route('admin.settings.edit') }}"
            class="group rounded-2xl border border-stone-200 bg-white p-4 transition hover:border-emerald-300 dark:border-stone-800 dark:bg-stone-900 dark:hover:border-emerald-700">
            <p class="text-sm font-bold text-stone-800 dark:text-stone-100">Ganti foto profil</p>
            <p class="mt-1 text-xs text-stone-500 dark:text-stone-400">Perbarui foto utama portofolio.</p>
        </a>
        <a href="{{ route('cv') }}"
            class="group rounded-2xl border border-stone-200 bg-white p-4 transition hover:border-emerald-300 dark:border-stone-800 dark:bg-stone-900 dark:hover:border-emerald-700">
            <p class="text-sm font-bold text-stone-800 dark:text-stone-100">Lihat CV</p>
            <p class="mt-1 text-xs text-stone-500 dark:text-stone-400">Pratinjau dan cetak CV.</p>
        </a>
        <a href="{{ route('home') }}"
            class="group rounded-2xl border border-stone-200 bg-white p-4 transition hover:border-emerald-300 dark:border-stone-800 dark:bg-stone-900 dark:hover:border-emerald-700">
            <p class="text-sm font-bold text-stone-800 dark:text-stone-100">Buka website</p>
            <p class="mt-1 text-xs text-stone-500 dark:text-stone-400">Lihat tampilan publik portofolio.</p>
        </a>
    </div>
@endsection
