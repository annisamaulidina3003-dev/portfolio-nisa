@extends('admin.layout')

@section('title', 'Edit Project')
@section('heading', 'Edit Project')
@section('subheading', 'Perbarui detail project yang sudah ada')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('admin.projects.index') }}"
            class="mb-4 inline-flex items-center gap-2 text-sm font-semibold text-stone-500 transition hover:text-emerald-600 dark:text-stone-400 dark:hover:text-emerald-400">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke daftar project
        </a>

        <div class="rounded-3xl border border-stone-200 bg-white p-6 shadow-sm dark:border-stone-800 dark:bg-stone-900 lg:p-8">
            <h2 class="text-lg font-black text-stone-900 dark:text-white">Detail Project</h2>
            <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">{{ $project->title }}</p>

            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data"
                class="mt-6 grid gap-5">
                @csrf
                @method('PUT')

                @include('admin.projects._fields')

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button type="submit"
                        class="inline-flex flex-1 items-center justify-center rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:from-emerald-700 hover:to-teal-700">
                        Update Project
                    </button>
                    <a href="{{ route('admin.projects.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-stone-100 px-6 py-3.5 text-sm font-bold text-stone-700 transition hover:bg-stone-200 dark:bg-stone-800 dark:text-stone-200 dark:hover:bg-stone-700">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
