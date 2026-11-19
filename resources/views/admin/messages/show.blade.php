@extends('admin.layout')

@section('title', 'Detail Pesan')
@section('heading', 'Detail Pesan')
@section('subheading', 'Baca pesan dan balas melalui email')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('admin.messages.index') }}"
            class="mb-4 inline-flex items-center gap-2 text-sm font-semibold text-stone-500 transition hover:text-emerald-600 dark:text-stone-400 dark:hover:text-emerald-400">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke pesan masuk
        </a>

        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <div class="flex flex-col gap-4 border-b border-stone-200 pb-5 dark:border-stone-800 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <span
                        class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-teal-100 text-base font-black text-teal-700 dark:bg-teal-950/60 dark:text-teal-300">
                        {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($message->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0">
                        <p class="font-black text-stone-900 dark:text-white">{{ $message->name }}</p>
                        <a href="mailto:{{ $message->email }}"
                            class="text-sm text-stone-500 transition hover:text-emerald-600 dark:text-stone-400 dark:hover:text-emerald-400">{{ $message->email }}</a>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span
                        class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">{{ $message->category }}</span>
                    <span class="text-xs text-stone-400">{{ $message->created_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
            </div>

            <p class="mt-5 whitespace-pre-line text-sm leading-relaxed text-stone-700 dark:text-stone-300">
                {{ $message->message }}</p>

            <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Balasan untuk pesan Anda') }}"
                    class="inline-flex flex-1 items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-6 py-3.5 text-sm font-bold text-white transition hover:bg-emerald-700">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    Balas via Email
                </a>

                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                    onsubmit="return confirm('Hapus pesan ini? Tindakan tidak dapat dibatalkan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-2xl bg-rose-100 px-6 py-3.5 text-sm font-bold text-rose-700 transition hover:bg-rose-200 dark:bg-rose-950/60 dark:text-rose-300 sm:w-auto">
                        Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
