@extends('admin.layout')

@section('title', 'Pesan Masuk')
@section('heading', 'Pesan Masuk')
@section('subheading', 'Kesan, masukan, dan feedback dari pengunjung')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form action="{{ route('admin.messages.index') }}" method="GET" class="w-full sm:max-w-xs">
            <select name="category" onchange="this.form.submit()"
                class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-semibold text-stone-700 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-900 dark:text-stone-200">
                <option value="">Semua kategori</option>
                @foreach ($categories as $option)
                    <option value="{{ $option }}" @selected($category === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </form>

        <p class="text-sm font-semibold text-stone-500 dark:text-stone-400">
            Total {{ $messages->total() }} pesan
        </p>
    </div>

    <div class="mt-5 grid gap-4">
        @forelse ($messages as $message)
            <div
                class="rounded-3xl border border-stone-200 bg-white p-5 shadow-sm transition hover:border-emerald-200 dark:border-stone-800 dark:bg-stone-900 dark:hover:border-emerald-800">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex items-start gap-3">
                        <span
                            class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-teal-100 text-sm font-black text-teal-700 dark:bg-teal-950/60 dark:text-teal-300">
                            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($message->name, 0, 1)) }}
                        </span>
                        <div class="min-w-0">
                            <p class="font-bold text-stone-900 dark:text-white">{{ $message->name }}</p>
                            <a href="mailto:{{ $message->email }}"
                                class="text-sm text-stone-500 transition hover:text-emerald-600 dark:text-stone-400 dark:hover:text-emerald-400">{{ $message->email }}</a>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span
                                    class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-bold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">{{ $message->category }}</span>
                                <span
                                    class="text-xs text-stone-400">{{ $message->created_at->translatedFormat('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex shrink-0 items-center gap-2">
                        <a href="{{ route('admin.messages.show', $message) }}"
                            class="rounded-lg bg-stone-100 px-3 py-1.5 text-xs font-bold text-stone-700 transition hover:bg-stone-200 dark:bg-stone-800 dark:text-stone-200 dark:hover:bg-stone-700">Lihat</a>
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                            onsubmit="return confirm('Hapus pesan ini? Tindakan tidak dapat dibatalkan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-bold text-rose-700 transition hover:bg-rose-200 dark:bg-rose-950/60 dark:text-rose-300">Hapus</button>
                        </form>
                    </div>
                </div>

                <p class="mt-4 line-clamp-2 text-sm leading-relaxed text-stone-600 dark:text-stone-300">
                    {{ $message->message }}</p>
            </div>
        @empty
            <div class="rounded-3xl border border-stone-200 bg-white px-6 py-16 text-center shadow-sm dark:border-stone-800 dark:bg-stone-900">
                <div
                    class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-stone-100 text-stone-400 dark:bg-stone-800 dark:text-stone-500">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.613a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <p class="mt-4 font-bold text-stone-700 dark:text-stone-200">Belum ada pesan masuk.</p>
                <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">Pesan dari formulir kontak akan muncul di
                    sini.</p>
            </div>
        @endforelse
    </div>

    @if ($messages->hasPages())
        <div class="mt-5">
            {{ $messages->links() }}
        </div>
    @endif
@endsection
