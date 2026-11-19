@extends('admin.layout')

@section('title', 'Sertifikat')
@section('heading', 'Sertifikat')
@section('subheading', 'Kelola sertifikat dan prestasi yang tampil di portofolio')

@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm font-semibold text-stone-500 dark:text-stone-400">Total {{ $certificates->total() }} sertifikat</p>

        <a href="{{ route('admin.certificates.create') }}"
            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:bg-emerald-700">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Sertifikat
        </a>
    </div>

    @if ($certificates->isEmpty())
        <div class="mt-5 rounded-3xl border border-stone-200 bg-white px-6 py-16 text-center shadow-sm dark:border-stone-800 dark:bg-stone-900">
            <div
                class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-stone-100 text-stone-400 dark:bg-stone-800 dark:text-stone-500">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m5.6 2A9 9 0 1112 3a9 9 0 018.6 6z" />
                </svg>
            </div>
            <p class="mt-4 font-bold text-stone-700 dark:text-stone-200">Belum ada sertifikat.</p>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">Tambahkan sertifikat pertama kamu.</p>
        </div>
    @else
        <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($certificates as $certificate)
                <article
                    class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm dark:border-stone-800 dark:bg-stone-900">
                    <div class="h-40 w-full overflow-hidden bg-stone-200 dark:bg-stone-800">
                        @if ($certificate->image && file_exists(public_path($certificate->image)))
                            <img src="{{ asset($certificate->image) }}" alt="{{ $certificate->title }}"
                                class="h-full w-full object-cover" />
                        @else
                            <div
                                class="grid h-full w-full place-items-center bg-gradient-to-br from-emerald-500 to-teal-600 text-white">
                                @if ($certificate->icon === 'briefcase')
                                    <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 7H4a2 2 0 00-2 2v9a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 7V5a2 2 0 012-2h2a2 2 0 012 2v2" />
                                    </svg>
                                @elseif ($certificate->icon === 'trophy')
                                    <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 21h8m-4-4v4m-6-9a6 6 0 1112 0 6 6 0 01-12 0zM7 17l-2 4m12-4l2 4" />
                                    </svg>
                                @else
                                    <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.6 2A9 9 0 1112 3a9 9 0 018.6 6z" />
                                    </svg>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <div class="flex items-center justify-between gap-2">
                            <span
                                class="rounded-full bg-stone-100 px-2.5 py-0.5 text-xs font-bold text-stone-600 dark:bg-stone-800 dark:text-stone-300">{{ $certificate->year ?: '—' }}</span>
                            <span
                                class="text-xs font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">{{ $certificate->icon }}</span>
                        </div>
                        <h3 class="mt-3 line-clamp-2 font-black text-stone-900 dark:text-white">{{ $certificate->title }}</h3>
                        <p class="mt-1 line-clamp-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                            {{ $certificate->issuer }}</p>
                        <p class="mt-2 line-clamp-2 text-sm text-stone-500 dark:text-stone-400">
                            {{ $certificate->description ?: 'Tanpa deskripsi' }}</p>

                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('admin.certificates.edit', $certificate) }}"
                                class="rounded-lg bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-700 transition hover:bg-amber-200 dark:bg-amber-950/60 dark:text-amber-300">Edit</a>
                            <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST"
                                onsubmit="return confirm('Hapus sertifikat ini? Tindakan tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-bold text-rose-700 transition hover:bg-rose-200 dark:bg-rose-950/60 dark:text-rose-300">Hapus</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif

    @if ($certificates->hasPages())
        <div class="mt-5">
            {{ $certificates->links() }}
        </div>
    @endif
@endsection
