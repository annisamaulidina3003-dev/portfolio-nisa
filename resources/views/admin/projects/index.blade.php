@extends('admin.layout')

@section('title', 'Projects')
@section('heading', 'Projects')
@section('subheading', 'Kelola karya yang tampil di galeri portofolio')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form action="{{ route('admin.projects.index') }}" method="GET" class="w-full sm:max-w-sm">
            <div class="relative">
                <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-stone-400"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="search" name="search" value="{{ $search }}" placeholder="Cari project..."
                    class="w-full rounded-2xl border border-stone-200 bg-white py-3 pl-11 pr-4 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-900 dark:text-stone-100" />
            </div>
        </form>

        <a href="{{ route('admin.projects.create') }}"
            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:bg-emerald-700">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Project
        </a>
    </div>

    <div class="mt-5 overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm dark:border-stone-800 dark:bg-stone-900">
        @if ($projects->isEmpty())
            <div class="px-6 py-16 text-center">
                <div
                    class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-stone-100 text-stone-400 dark:bg-stone-800 dark:text-stone-500">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                </div>
                <p class="mt-4 font-bold text-stone-700 dark:text-stone-200">
                    {{ $search ? 'Project tidak ditemukan.' : 'Belum ada project.' }}</p>
                <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">
                    {{ $search ? 'Coba kata kunci lain.' : 'Tambahkan project pertama kamu untuk ditampilkan di galeri.' }}
                </p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead
                        class="border-b border-stone-200 bg-stone-50 text-xs font-bold uppercase tracking-wider text-stone-500 dark:border-stone-800 dark:bg-stone-950/60 dark:text-stone-400">
                        <tr>
                            <th class="px-5 py-3">Project</th>
                            <th class="px-5 py-3">Ditambahkan</th>
                            <th class="px-5 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 dark:divide-stone-800">
                        @foreach ($projects as $project)
                            <tr class="transition hover:bg-stone-50 dark:hover:bg-stone-800/40">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-12 w-16 shrink-0 overflow-hidden rounded-xl bg-stone-200 dark:bg-stone-800">
                                            @if ($project->image_data_url)
                                                <img src="{{ $project->image_data_url }}" alt="{{ $project->title }}"
                                                    class="h-full w-full object-cover" />
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="truncate font-bold text-stone-800 dark:text-stone-100">
                                                {{ $project->title }}</p>
                                            <p class="mt-0.5 line-clamp-1 text-xs text-stone-500 dark:text-stone-400">
                                                {{ $project->description ?: 'Tanpa deskripsi' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-stone-500 dark:text-stone-400">
                                    {{ $project->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.projects.edit', $project) }}"
                                            class="rounded-lg bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-700 transition hover:bg-amber-200 dark:bg-amber-950/60 dark:text-amber-300">Edit</a>
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                            onsubmit="return confirm('Hapus project ini? Tindakan tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-bold text-rose-700 transition hover:bg-rose-200 dark:bg-rose-950/60 dark:text-rose-300">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if ($projects->hasPages())
        <div class="mt-5">
            {{ $projects->links() }}
        </div>
    @endif
@endsection
