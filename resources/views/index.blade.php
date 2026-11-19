@php
    $profile = config('portfolio.profile');
    $about = config('portfolio.about');
    $contact = config('portfolio.contact');
    $featured = config('portfolio.featured_project');
    $profilePhotoFiles = glob(public_path('image/profile-photo.*')) ?: [];
    $profilePhoto = $profilePhotoFiles ? 'image/'.basename($profilePhotoFiles[0]) : $profile['photo'];
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="{{ $profile['name'] }} — {{ $profile['tagline'] }}. Portofolio {{ $profile['class'] }} {{ $profile['major'] }}." />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $profile['name'] }} — Portofolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script>
        (function() {
            try {
                const theme = localStorage.getItem('theme');
                if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (error) {
                /* ignore */
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-stone-50 text-stone-800 antialiased selection:bg-emerald-200 dark:bg-stone-950 dark:text-stone-100">

    <a href="#beranda"
        class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-xl focus:bg-emerald-600 focus:px-4 focus:py-2 focus:text-white">
        Lewati ke konten
    </a>

    @if (session('success'))
        <div data-flash
            class="fixed left-1/2 top-24 z-[60] w-[calc(100%-2rem)] max-w-md -translate-x-1/2 rounded-2xl border border-emerald-200 bg-white px-5 py-4 text-center text-sm font-bold text-emerald-700 shadow-xl transition-opacity duration-500 dark:border-emerald-800 dark:bg-stone-900 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div data-flash
            class="fixed left-1/2 top-24 z-[60] w-[calc(100%-2rem)] max-w-md -translate-x-1/2 rounded-2xl border border-rose-200 bg-white px-5 py-4 text-center text-sm font-bold text-rose-700 shadow-xl transition-opacity duration-500 dark:border-rose-800 dark:bg-stone-900 dark:text-rose-300">
            {{ session('error') }}
        </div>
    @endif

    <!-- NAVBAR -->
    <header
        class="fixed inset-x-0 top-0 z-50 border-b border-stone-200/70 bg-white/80 backdrop-blur-xl transition-colors dark:border-stone-800/70 dark:bg-stone-950/80">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between gap-4 px-5 lg:px-8">
            <a href="#beranda" class="flex items-center gap-3">
                <span
                    class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-sm font-black text-white shadow-lg shadow-emerald-500/25">
                    {{ $profile['initials'] }}
                </span>
                <span class="hidden text-lg font-black tracking-tight sm:inline">
                    <span class="gradient-text">{{ $profile['name'] }}</span>
                </span>
            </a>

            <nav class="hidden items-center gap-6 text-sm font-semibold text-stone-600 dark:text-stone-300 xl:flex">
                <a href="#tentang" class="transition hover:text-emerald-600 dark:hover:text-emerald-400">Tentang</a>
                <a href="#keahlian" class="transition hover:text-emerald-600 dark:hover:text-emerald-400">Keahlian</a>
                <a href="#proyek" class="transition hover:text-emerald-600 dark:hover:text-emerald-400">Proyek</a>
                <a href="#sertifikat" class="transition hover:text-emerald-600 dark:hover:text-emerald-400">Sertifikat</a>
                <a href="#pengalaman" class="transition hover:text-emerald-600 dark:hover:text-emerald-400">Pengalaman</a>
                <a href="#blog" class="transition hover:text-emerald-600 dark:hover:text-emerald-400">Blog</a>
                <a href="#kontak" class="transition hover:text-emerald-600 dark:hover:text-emerald-400">Kontak</a>
            </nav>

            <div class="flex items-center gap-2 sm:gap-3">
                <button type="button" id="theme-toggle" aria-label="Ubah tema"
                    class="grid h-11 w-11 place-items-center rounded-2xl border border-stone-200 bg-white text-stone-600 transition hover:border-emerald-300 hover:text-emerald-600 dark:border-stone-800 dark:bg-stone-900 dark:text-stone-300 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                    <svg class="h-5 w-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                    </svg>
                    <svg class="hidden h-5 w-5 dark:block" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <circle cx="12" cy="12" r="4" />
                        <path stroke-linecap="round"
                            d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                    </svg>
                </button>

                <a href="#kontak"
                    class="hidden items-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:bg-emerald-700 sm:inline-flex">
                    Hubungi Saya
                </a>

                @if (auth()->user()?->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="hidden items-center gap-2 rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:bg-emerald-700 sm:inline-flex">
                        Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-bold text-stone-700 transition hover:border-rose-300 hover:text-rose-600 dark:border-stone-800 dark:bg-stone-900 dark:text-stone-200 dark:hover:border-rose-800 dark:hover:text-rose-400">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-2xl border border-stone-200 bg-white px-4 py-3 text-sm font-bold text-stone-700 transition hover:border-emerald-300 hover:text-emerald-600 dark:border-stone-800 dark:bg-stone-900 dark:text-stone-200 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                        Login
                    </a>
                @endif

                <button type="button" id="menu-toggle" aria-label="Buka menu"
                    class="grid h-11 w-11 place-items-center rounded-2xl border border-stone-200 bg-white text-stone-600 dark:border-stone-800 dark:bg-stone-900 dark:text-stone-300 xl:hidden">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu"
            class="hidden border-t border-stone-200 bg-white px-5 py-5 dark:border-stone-800 dark:bg-stone-950 xl:hidden">
            <nav class="grid gap-1 text-sm font-semibold text-stone-700 dark:text-stone-200">
                @if (auth()->user()?->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="rounded-xl bg-emerald-50 px-4 py-3 font-bold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">Dashboard Admin</a>
                @endif
                <a href="#tentang" class="rounded-xl px-4 py-3 hover:bg-stone-100 dark:hover:bg-stone-900">Tentang</a>
                <a href="#keahlian" class="rounded-xl px-4 py-3 hover:bg-stone-100 dark:hover:bg-stone-900">Keahlian</a>
                <a href="#proyek" class="rounded-xl px-4 py-3 hover:bg-stone-100 dark:hover:bg-stone-900">Proyek</a>
                <a href="#sertifikat"
                    class="rounded-xl px-4 py-3 hover:bg-stone-100 dark:hover:bg-stone-900">Sertifikat</a>
                <a href="#pengalaman"
                    class="rounded-xl px-4 py-3 hover:bg-stone-100 dark:hover:bg-stone-900">Pengalaman</a>
                <a href="#blog" class="rounded-xl px-4 py-3 hover:bg-stone-100 dark:hover:bg-stone-900">Blog</a>
                <a href="#kontak" class="rounded-xl px-4 py-3 hover:bg-stone-100 dark:hover:bg-stone-900">Kontak</a>
            </nav>
        </div>
    </header>

    <main>
        <!-- HERO -->
        <section id="beranda" class="relative overflow-hidden bg-stone-50 pt-32 pb-20 dark:bg-stone-950 lg:pt-40">
            <div
                class="pointer-events-none absolute -top-24 -right-24 h-96 w-96 rounded-full bg-emerald-400/20 blur-3xl dark:bg-emerald-500/10">
            </div>
            <div
                class="pointer-events-none absolute top-1/2 -left-32 h-80 w-80 rounded-full bg-teal-400/20 blur-3xl dark:bg-teal-500/10">
            </div>

            <div
                class="relative mx-auto grid max-w-7xl gap-16 px-5 lg:grid-cols-[1.15fr_0.85fr] lg:items-center lg:px-8">
                <div class="reveal">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-xs font-bold text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-500 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        </span>
                        Tersedia untuk peluang &amp; kolaborasi
                    </span>

                    <h1
                        class="mt-6 text-4xl font-black leading-[1.05] tracking-tight text-stone-900 dark:text-white sm:text-5xl lg:text-6xl">
                        Halo, saya
                        <span class="gradient-text">{{ $profile['name'] }}</span>
                    </h1>

                    <p class="mt-4 text-lg font-semibold text-stone-600 dark:text-stone-300 sm:text-xl">
                        Seorang
                        <span id="typing-role" data-roles='@json($profile['roles'])'
                            class="typing-cursor font-bold text-emerald-600 dark:text-emerald-400"></span>
                    </p>

                    <p class="mt-5 max-w-2xl text-base leading-relaxed text-stone-600 dark:text-stone-400">
                        {{ $profile['description'] }}
                    </p>

                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach ($profile['skills'] as $skill)
                            <span
                                class="rounded-full border border-stone-200 bg-white px-3.5 py-1.5 text-xs font-semibold text-stone-600 dark:border-stone-800 dark:bg-stone-900 dark:text-stone-300">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="#proyek"
                            class="inline-flex items-center gap-2 rounded-2xl bg-stone-900 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-stone-900/10 transition hover:-translate-y-0.5 hover:bg-stone-800 dark:bg-white dark:text-stone-900 dark:hover:bg-stone-100">
                            Lihat Portfolio
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('cv') }}" target="_blank" rel="noopener"
                            class="inline-flex items-center gap-2 rounded-2xl bg-emerald-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/25 transition hover:-translate-y-0.5 hover:bg-emerald-700">
                            Lihat CV
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                            </svg>
                        </a>
                        <a href="#kontak"
                            class="inline-flex items-center gap-2 rounded-2xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-bold text-stone-700 transition hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 dark:border-stone-700 dark:bg-stone-900 dark:text-stone-200 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                            Hubungi Saya
                        </a>
                    </div>

                    <div class="mt-10 grid gap-3 sm:grid-cols-3">
                        <div
                            class="rounded-2xl border border-stone-200 bg-white/70 p-4 dark:border-stone-800 dark:bg-stone-900/60">
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-500 dark:text-stone-400">
                                Status</p>
                            <p class="mt-1 text-sm font-bold text-stone-900 dark:text-white">Siswa PPLG</p>
                        </div>
                        <div
                            class="rounded-2xl border border-stone-200 bg-white/70 p-4 dark:border-stone-800 dark:bg-stone-900/60">
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-500 dark:text-stone-400">
                                Kelas</p>
                            <p class="mt-1 text-sm font-bold text-stone-900 dark:text-white">{{ $profile['class'] }}</p>
                        </div>
                        <div
                            class="rounded-2xl border border-stone-200 bg-white/70 p-4 dark:border-stone-800 dark:bg-stone-900/60">
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-500 dark:text-stone-400">
                                Domisili</p>
                            <p class="mt-1 text-sm font-bold text-stone-900 dark:text-white">Banjarmasin</p>
                        </div>
                    </div>
                </div>

                <div class="relative mx-auto w-full max-w-sm reveal">
                    <div
                        class="absolute inset-6 rounded-[2.5rem] bg-gradient-to-br from-emerald-400 to-teal-500 opacity-30 blur-2xl">
                    </div>

                    <div class="relative">
                        <div
                            class="overflow-hidden rounded-[2.5rem] border-8 border-white bg-stone-200 shadow-2xl dark:border-stone-900 dark:bg-stone-800">
                            <img src="{{ asset($profilePhoto) }}" alt="Foto {{ $profile['name'] }}"
                                class="aspect-[4/5] w-full object-cover" loading="eager" />
                        </div>

                        <div
                            class="float-slow absolute -left-6 top-10 rounded-2xl border border-stone-200 bg-white/90 px-4 py-3 shadow-xl backdrop-blur dark:border-stone-700 dark:bg-stone-900/90">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                                Full-Stack</p>
                            <p class="text-sm font-black text-stone-900 dark:text-white">Web Developer</p>
                        </div>

                        <div
                            class="float-slow absolute -right-4 bottom-12 rounded-2xl border border-stone-200 bg-white/90 px-4 py-3 shadow-xl backdrop-blur dark:border-stone-700 dark:bg-stone-900/90"
                            style="animation-delay: 1.5s">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400">
                                Stack</p>
                            <p class="text-sm font-black text-stone-900 dark:text-white">Laravel · Tailwind</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TENTANG -->
        <section id="tentang" class="scroll-mt-24 bg-white py-20 dark:bg-stone-950 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center reveal">
                    <span
                        class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300">
                        Tentang Saya
                    </span>
                    <h2
                        class="mt-4 text-3xl font-black tracking-tight text-stone-900 dark:text-white sm:text-4xl lg:text-5xl">
                        Kenali Saya Lebih Dekat</h2>
                    <p class="mt-4 text-stone-600 dark:text-stone-400">
                        Perjalanan belajar, minat teknologi, dan pengalaman yang membentuk saya sebagai calon
                        pengembang web profesional.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 lg:grid-cols-2">
                    <div
                        class="rounded-[2rem] border border-stone-200 bg-stone-50 p-7 dark:border-stone-800 dark:bg-stone-900/60 reveal lg:p-9">
                        <h3 class="text-xl font-black text-stone-900 dark:text-white">Biodata Singkat</h3>
                        <dl class="mt-6 space-y-4 text-sm">
                            <div class="flex justify-between gap-4 border-b border-stone-200 pb-4 dark:border-stone-800">
                                <dt class="font-semibold text-stone-500 dark:text-stone-400">Nama Lengkap</dt>
                                <dd class="text-right font-bold text-stone-900 dark:text-white">{{ $profile['name'] }}
                                </dd>
                            </div>
                            <div class="flex justify-between gap-4 border-b border-stone-200 pb-4 dark:border-stone-800">
                                <dt class="font-semibold text-stone-500 dark:text-stone-400">Tempat, Tanggal Lahir</dt>
                                <dd class="text-right font-bold text-stone-900 dark:text-white">{{ $profile['birth'] }}
                                </dd>
                            </div>
                            <div class="flex justify-between gap-4 border-b border-stone-200 pb-4 dark:border-stone-800">
                                <dt class="font-semibold text-stone-500 dark:text-stone-400">Status</dt>
                                <dd class="text-right font-bold text-stone-900 dark:text-white">{{ $profile['status'] }}
                                </dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="font-semibold text-stone-500 dark:text-stone-400">Domisili</dt>
                                <dd class="text-right font-bold text-stone-900 dark:text-white">
                                    {{ $profile['domicile'] }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div
                        class="rounded-[2rem] border border-stone-200 bg-stone-50 p-7 dark:border-stone-800 dark:bg-stone-900/60 reveal lg:p-9">
                        <h3 class="text-xl font-black text-stone-900 dark:text-white">Minat &amp; Teknologi</h3>

                        <p class="mt-6 text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400">
                            Bidang yang Diminati</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach ($about['interests'] as $interest)
                                <span
                                    class="rounded-full bg-emerald-100 px-3.5 py-1.5 text-xs font-semibold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">{{ $interest }}</span>
                            @endforeach
                        </div>

                        <p
                            class="mt-6 text-xs font-bold uppercase tracking-wider text-stone-500 dark:text-stone-400">
                            Teknologi yang Dikuasai</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach ($about['technologies'] as $technology)
                                <span
                                    class="rounded-full border border-stone-200 bg-white px-3.5 py-1.5 text-xs font-semibold text-stone-600 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-300">{{ $technology }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                    <div
                        class="rounded-[2rem] border border-stone-200 bg-stone-50 p-7 dark:border-stone-800 dark:bg-stone-900/60 reveal lg:p-9">
                        <h3 class="text-xl font-black text-stone-900 dark:text-white">Riwayat Pendidikan</h3>
                        <div class="mt-7 space-y-7 border-l-2 border-emerald-500/40 pl-6">
                            @foreach (config('portfolio.education') as $education)
                                <div class="relative">
                                    <span
                                        class="absolute -left-[31px] top-1.5 h-4 w-4 rounded-full border-4 border-white bg-emerald-500 dark:border-stone-900"></span>
                                    <span
                                        class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">{{ $education['period'] }}</span>
                                    <h4 class="mt-2 font-black text-stone-900 dark:text-white">{{ $education['school'] }}
                                    </h4>
                                    <p class="mt-1 text-sm text-stone-600 dark:text-stone-400">
                                        {{ $education['description'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid gap-6">
                        <div
                            class="rounded-[2rem] border border-stone-200 bg-stone-50 p-7 dark:border-stone-800 dark:bg-stone-900/60 reveal">
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                                Organisasi</p>
                            <h4 class="mt-2 font-black text-stone-900 dark:text-white">
                                {{ config('portfolio.organization.role') }}</h4>
                            <p class="text-sm font-semibold text-stone-500 dark:text-stone-400">
                                {{ config('portfolio.organization.place') }} ·
                                {{ config('portfolio.organization.period') }}</p>
                            <p class="mt-3 text-sm leading-relaxed text-stone-600 dark:text-stone-400">
                                {{ config('portfolio.organization.description') }}</p>
                        </div>

                        <div
                            class="rounded-[2rem] border border-stone-200 bg-stone-50 p-7 dark:border-stone-800 dark:bg-stone-900/60 reveal">
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                                Praktik Kerja Lapangan</p>
                            <h4 class="mt-2 font-black text-stone-900 dark:text-white">
                                {{ config('portfolio.internship.role') }}</h4>
                            <p class="text-sm font-semibold text-stone-500 dark:text-stone-400">
                                {{ config('portfolio.internship.place') }} ·
                                {{ config('portfolio.internship.period') }}</p>
                            <p class="mt-3 text-sm leading-relaxed text-stone-600 dark:text-stone-400">
                                {{ config('portfolio.internship.description') }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="mt-6 overflow-hidden rounded-[2rem] bg-gradient-to-r from-emerald-600 to-teal-600 p-8 text-white reveal lg:p-10">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-emerald-100">Cita-Cita &amp; Tujuan Karir</p>
                    <p class="mt-3 max-w-4xl text-lg font-semibold leading-relaxed lg:text-xl">
                        “{{ $profile['career_goal'] }}”</p>
                </div>
            </div>
        </section>

        <!-- KEAHLIAN -->
        <section id="keahlian" class="scroll-mt-24 bg-stone-100 py-20 dark:bg-stone-900/50 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center reveal">
                    <span
                        class="inline-flex rounded-full border border-emerald-200 bg-white px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-900 dark:bg-stone-950 dark:text-emerald-300">
                        Keahlian
                    </span>
                    <h2
                        class="mt-4 text-3xl font-black tracking-tight text-stone-900 dark:text-white sm:text-4xl lg:text-5xl">
                        Skill &amp; Kompetensi</h2>
                    <p class="mt-4 text-stone-600 dark:text-stone-400">
                        Kombinasi kemampuan teknis dan non-teknis yang terus saya asah melalui proyek nyata.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 lg:grid-cols-2">
                    <div
                        class="rounded-[2rem] border border-stone-200 bg-white p-7 shadow-sm dark:border-stone-800 dark:bg-stone-950 reveal lg:p-9">
                        <div class="flex items-center gap-3">
                            <span
                                class="grid h-11 w-11 place-items-center rounded-2xl bg-emerald-100 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </span>
                            <h3 class="text-xl font-black text-stone-900 dark:text-white">Hard Skills (Teknis)</h3>
                        </div>

                        <div class="mt-7 space-y-5">
                            @foreach (config('portfolio.hard_skills') as $skill)
                                <div>
                                    <div class="flex items-center justify-between text-sm font-semibold">
                                        <span class="text-stone-700 dark:text-stone-200">{{ $skill['name'] }}</span>
                                        <span
                                            class="text-stone-500 dark:text-stone-400">{{ $skill['level'] }}%</span>
                                    </div>
                                    <div
                                        class="mt-2 h-2.5 overflow-hidden rounded-full bg-stone-200 dark:bg-stone-800">
                                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-teal-500"
                                            style="width: {{ $skill['level'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div
                        class="rounded-[2rem] border border-stone-200 bg-white p-7 shadow-sm dark:border-stone-800 dark:bg-stone-950 reveal lg:p-9">
                        <div class="flex items-center gap-3">
                            <span
                                class="grid h-11 w-11 place-items-center rounded-2xl bg-teal-100 text-teal-600 dark:bg-teal-950/60 dark:text-teal-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-6.9M17 8a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <h3 class="text-xl font-black text-stone-900 dark:text-white">Soft Skills (Non-Teknis)</h3>
                        </div>

                        <div class="mt-7 space-y-5">
                            @foreach (config('portfolio.soft_skills') as $skill)
                                <div>
                                    <div class="flex items-center justify-between text-sm font-semibold">
                                        <span class="text-stone-700 dark:text-stone-200">{{ $skill['name'] }}</span>
                                        <span
                                            class="text-stone-500 dark:text-stone-400">{{ $skill['level'] }}%</span>
                                    </div>
                                    <div
                                        class="mt-2 h-2.5 overflow-hidden rounded-full bg-stone-200 dark:bg-stone-800">
                                        <div class="h-full rounded-full bg-gradient-to-r from-teal-500 to-cyan-500"
                                            style="width: {{ $skill['level'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PROYEK -->
        <section id="proyek" class="scroll-mt-24 bg-white py-20 dark:bg-stone-950 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl reveal">
                        <span
                            class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300">
                            Galeri Proyek
                        </span>
                        <h2
                            class="mt-4 text-3xl font-black tracking-tight text-stone-900 dark:text-white sm:text-4xl lg:text-5xl">
                            Karya &amp; Proyek</h2>
                        <p class="mt-4 text-stone-600 dark:text-stone-400">
                            Proyek utama UKK beserta karya lain yang saya kembangkan selama belajar di PPLG.
                        </p>
                    </div>

                </div>

                <!-- PROYEK UTAMA -->
                <div
                    class="mt-12 overflow-hidden rounded-[2rem] border border-stone-200 bg-stone-50 shadow-sm dark:border-stone-800 dark:bg-stone-900/60 reveal">
                    <div class="grid lg:grid-cols-2">
                        <div
                            class="relative overflow-hidden bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-600 p-6 lg:p-10">
                            <div class="rounded-2xl bg-stone-950/90 p-4 shadow-2xl">
                                <div class="flex items-center gap-1.5">
                                    <span class="h-2.5 w-2.5 rounded-full bg-rose-400"></span>
                                    <span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span>
                                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                                    <span
                                        class="ml-3 flex-1 truncate rounded-md bg-white/10 px-3 py-1 text-[10px] font-semibold text-stone-300">demo-portfolio-ukk.test/dashboard</span>
                                </div>

                                <div class="mt-5 grid grid-cols-3 gap-2">
                                    <div class="rounded-xl bg-white/5 p-3">
                                        <p class="text-[10px] font-semibold text-stone-400">Proyek</p>
                                        <p class="mt-1 text-lg font-black text-white">24</p>
                                    </div>
                                    <div class="rounded-xl bg-white/5 p-3">
                                        <p class="text-[10px] font-semibold text-stone-400">Siswa</p>
                                        <p class="mt-1 text-lg font-black text-white">128</p>
                                    </div>
                                    <div class="rounded-xl bg-white/5 p-3">
                                        <p class="text-[10px] font-semibold text-stone-400">Sertifikat</p>
                                        <p class="mt-1 text-lg font-black text-white">96</p>
                                    </div>
                                </div>

                                <div class="mt-4 space-y-2">
                                    <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
                                        <span class="h-8 w-8 rounded-lg bg-emerald-500/20"></span>
                                        <div class="flex-1">
                                            <div class="h-2 w-2/3 rounded-full bg-white/30"></div>
                                            <div class="mt-1.5 h-1.5 w-1/2 rounded-full bg-white/15"></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">
                                        <span class="h-8 w-8 rounded-lg bg-teal-500/20"></span>
                                        <div class="flex-1">
                                            <div class="h-2 w-1/2 rounded-full bg-white/30"></div>
                                            <div class="mt-1.5 h-1.5 w-2/3 rounded-full bg-white/15"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p
                                class="mt-5 text-center text-xs font-bold uppercase tracking-[0.3em] text-emerald-50/90">
                                Dashboard Admin EduProject Hub
                            </p>
                        </div>

                        <div class="p-7 lg:p-10">
                            <div class="flex flex-wrap items-center gap-2">
                                <span
                                    class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">Proyek
                                    UKK</span>
                                <span
                                    class="rounded-full border border-stone-200 px-3 py-1 text-xs font-bold text-stone-500 dark:border-stone-700 dark:text-stone-400">{{ $featured['role'] }}</span>
                            </div>

                            <h3 class="mt-4 text-2xl font-black text-stone-900 dark:text-white lg:text-3xl">
                                {{ $featured['name'] }}</h3>
                            <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">
                                {{ $featured['subtitle'] }}</p>
                            <p class="mt-4 text-sm leading-relaxed text-stone-600 dark:text-stone-400">
                                {{ $featured['description'] }}</p>

                            <div class="mt-5 flex flex-wrap gap-2">
                                @foreach ($featured['technologies'] as $technology)
                                    <span
                                        class="rounded-lg bg-stone-200/70 px-2.5 py-1 text-xs font-semibold text-stone-700 dark:bg-stone-800 dark:text-stone-300">{{ $technology }}</span>
                                @endforeach
                            </div>

                            <ul class="mt-5 space-y-2">
                                @foreach ($featured['features'] as $feature)
                                    <li class="flex items-start gap-2 text-sm text-stone-600 dark:text-stone-400">
                                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-emerald-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="{{ $featured['demo_url'] }}" target="_blank" rel="noopener"
                                    class="inline-flex items-center gap-2 rounded-xl bg-stone-900 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-stone-800 dark:bg-white dark:text-stone-900 dark:hover:bg-stone-100">
                                    Live Demo
                                </a>
                                <a href="{{ $featured['source_url'] }}" target="_blank" rel="noopener"
                                    class="inline-flex items-center gap-2 rounded-xl border border-stone-300 px-4 py-2.5 text-xs font-bold text-stone-700 transition hover:border-emerald-300 hover:text-emerald-600 dark:border-stone-700 dark:text-stone-200 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                                    Source Code
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-6 border-t border-stone-200 p-7 dark:border-stone-800 lg:grid-cols-3 lg:p-10">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                                Permasalahan</p>
                            <ul class="mt-3 space-y-2 text-sm text-stone-600 dark:text-stone-400">
                                @foreach ($featured['problems'] as $problem)
                                    <li class="flex gap-2"><span class="text-emerald-500">•</span>{{ $problem }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                                Tujuan Proyek</p>
                            <ul class="mt-3 space-y-2 text-sm text-stone-600 dark:text-stone-400">
                                @foreach ($featured['goals'] as $goal)
                                    <li class="flex gap-2"><span class="text-emerald-500">•</span>{{ $goal }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">
                                Proses Pengerjaan</p>
                            <ol class="mt-3 space-y-2 text-sm text-stone-600 dark:text-stone-400">
                                @foreach ($featured['process'] as $index => $step)
                                    <li class="flex gap-2"><span
                                            class="font-bold text-emerald-500">{{ $index + 1 }}.</span>{{ $step }}
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>

                    <div
                        class="border-t border-stone-200 bg-white/60 px-7 py-5 dark:border-stone-800 dark:bg-stone-950/40 lg:px-10">
                        <p class="text-sm italic text-stone-600 dark:text-stone-400">“{{ $featured['feedback'] }}”</p>
                        <p class="mt-2 text-xs text-stone-500 dark:text-stone-500">{{ $featured['detail'] }}</p>
                    </div>
                </div>

                <!-- GALERI DINAMIS -->
                <div class="mt-16">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between reveal">
                        <div>
                            <h3 class="text-2xl font-black text-stone-900 dark:text-white">Galeri Karya Lainnya</h3>
                            <p class="mt-1 text-sm text-stone-600 dark:text-stone-400">Dokumentasi proyek yang
                                ditambahkan melalui dashboard admin.</p>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        @forelse ($portofolios as $portofolio)
                            <article
                                class="group overflow-hidden rounded-3xl border border-stone-200 bg-stone-50 shadow-sm card-hover dark:border-stone-800 dark:bg-stone-900/60 reveal">
                                <div class="overflow-hidden bg-stone-200 dark:bg-stone-800">
                                    @if ($portofolio->image_data_url)
                                        <img src="{{ $portofolio->image_data_url }}" alt="{{ $portofolio->title }}"
                                            class="h-56 w-full object-cover transition duration-500 group-hover:scale-105"
                                            loading="lazy" />
                                    @else
                                        <div
                                            class="grid h-56 w-full place-items-center bg-gradient-to-br from-emerald-500 to-teal-600 text-white">
                                            <span class="text-3xl font-black">{{ $portofolio->title }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6">
                                    <h4 class="text-lg font-black text-stone-900 dark:text-white">
                                        {{ $portofolio->title }}</h4>
                                    <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-stone-600 dark:text-stone-400">
                                        {{ $portofolio->description }}</p>
                                </div>
                            </article>
                        @empty
                            <div
                                class="col-span-full rounded-3xl border border-dashed border-stone-300 bg-stone-50 p-12 text-center dark:border-stone-700 dark:bg-stone-900/40">
                                <p class="font-bold text-stone-700 dark:text-stone-200">Belum ada karya tambahan.</p>
                                <p class="mt-1 text-sm text-stone-500 dark:text-stone-400">Proyek baru akan tampil di
                                    sini setelah ditambahkan melalui dashboard admin.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- SERTIFIKAT -->
        <section id="sertifikat" class="scroll-mt-24 bg-stone-100 py-20 dark:bg-stone-900/50 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center reveal">
                    <span
                        class="inline-flex rounded-full border border-emerald-200 bg-white px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-900 dark:bg-stone-950 dark:text-emerald-300">
                        Sertifikat &amp; Prestasi
                    </span>
                    <h2
                        class="mt-4 text-3xl font-black tracking-tight text-stone-900 dark:text-white sm:text-4xl lg:text-5xl">
                        Pengakuan Kompetensi</h2>
                    <p class="mt-4 text-stone-600 dark:text-stone-400">
                        Bukti pembelajaran dan kompetensi yang saya raih selama menempuh pendidikan di SMK.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($certificates as $certificate)
                        <article
                            class="rounded-[2rem] border border-stone-200 bg-white p-7 shadow-sm card-hover dark:border-stone-800 dark:bg-stone-950 reveal">
                            @if (!empty($certificate['image']) && file_exists(public_path($certificate['image'])))
                                <a href="{{ asset($certificate['image']) }}" target="_blank" rel="noopener"
                                    class="block overflow-hidden rounded-2xl">
                                    <img src="{{ asset($certificate['image']) }}"
                                        alt="Sertifikat {{ $certificate['title'] }}"
                                        class="h-48 w-full object-cover transition duration-300 hover:scale-105">
                                </a>
                            @else
                            <span
                                class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-100 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-400">
                                @if ($certificate['icon'] === 'briefcase')
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 7H4a2 2 0 00-2 2v9a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 7V5a2 2 0 012-2h2a2 2 0 012 2v2" />
                                    </svg>
                                @elseif ($certificate['icon'] === 'badge')
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.6 2A9 9 0 1112 3a9 9 0 018.6 6z" />
                                    </svg>
                                @else
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 21h8m-4-4v4m-6-9a6 6 0 1112 0 6 6 0 01-12 0zM7 17l-2 4m12-4l2 4" />
                                    </svg>
                                @endif
                            </span>
                            @endif

                            <div class="mt-5 flex items-center justify-between gap-3">
                                <span
                                    class="rounded-full bg-stone-100 px-3 py-1 text-xs font-bold text-stone-600 dark:bg-stone-800 dark:text-stone-300">{{ $certificate['year'] }}</span>
                            </div>

                            <h3 class="mt-3 text-lg font-black leading-snug text-stone-900 dark:text-white">
                                {{ $certificate['title'] }}</h3>
                            <p class="mt-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ $certificate['issuer'] }}</p>
                            <p class="mt-3 text-sm leading-relaxed text-stone-600 dark:text-stone-400">
                                {{ $certificate['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- PENGALAMAN -->
        <section id="pengalaman" class="scroll-mt-24 bg-white py-20 dark:bg-stone-950 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center reveal">
                    <span
                        class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300">
                        Pengalaman
                    </span>
                    <h2
                        class="mt-4 text-3xl font-black tracking-tight text-stone-900 dark:text-white sm:text-4xl lg:text-5xl">
                        Jejak Perjalanan</h2>
                    <p class="mt-4 text-stone-600 dark:text-stone-400">
                        Pengalaman organisasi, praktik kerja lapangan, dan kompetisi yang membentuk cara saya bekerja.
                    </p>
                </div>

                <div class="mx-auto mt-14 max-w-3xl">
                    <div class="space-y-8 border-l-2 border-emerald-500/40 pl-8">
                        @foreach (config('portfolio.experiences') as $experience)
                            <div class="relative reveal">
                                <span
                                    class="absolute -left-[41px] top-2 grid h-6 w-6 place-items-center rounded-full border-4 border-white bg-emerald-500 dark:border-stone-950">
                                    <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                                </span>
                                <div
                                    class="rounded-2xl border border-stone-200 bg-stone-50 p-6 dark:border-stone-800 dark:bg-stone-900/60">
                                    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                        <h3 class="text-lg font-black text-stone-900 dark:text-white">
                                            {{ $experience['title'] }}</h3>
                                        <span
                                            class="text-xs font-bold text-emerald-600 dark:text-emerald-400">{{ $experience['period'] }}</span>
                                    </div>
                                    <p class="text-sm font-semibold text-stone-500 dark:text-stone-400">
                                        {{ $experience['place'] }}</p>
                                    <p class="mt-2 text-sm leading-relaxed text-stone-600 dark:text-stone-400">
                                        {{ $experience['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- CV -->
        <section id="cv" class="scroll-mt-24 bg-stone-100 py-20 dark:bg-stone-900/50 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div
                    class="overflow-hidden rounded-[2rem] border border-stone-200 bg-white shadow-sm dark:border-stone-800 dark:bg-stone-950 reveal">
                    <div class="grid gap-8 p-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center lg:p-12">
                        <div>
                            <span
                                class="inline-flex rounded-full bg-emerald-100 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">CV
                                Digital</span>
                            <h2 class="mt-4 text-3xl font-black text-stone-900 dark:text-white lg:text-4xl">Resume
                                Singkat</h2>
                            <p class="mt-4 max-w-2xl leading-relaxed text-stone-600 dark:text-stone-400">
                                {{ config('portfolio.cv_summary') }}</p>

                            <div class="mt-6 grid gap-3 sm:grid-cols-3">
                                <div class="rounded-2xl bg-stone-100 p-4 dark:bg-stone-900">
                                    <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">Nama</p>
                                    <p class="mt-1 text-sm font-bold text-stone-900 dark:text-white">
                                        {{ $profile['name'] }}</p>
                                </div>
                                <div class="rounded-2xl bg-stone-100 p-4 dark:bg-stone-900">
                                    <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">Kelas</p>
                                    <p class="mt-1 text-sm font-bold text-stone-900 dark:text-white">
                                        {{ $profile['class'] }}</p>
                                </div>
                                <div class="rounded-2xl bg-stone-100 p-4 dark:bg-stone-900">
                                    <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">Kompetensi</p>
                                    <p class="mt-1 text-sm font-bold text-stone-900 dark:text-white">PPLG / RPL</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-start gap-3 lg:items-end">
                            <a href="{{ route('cv') }}" target="_blank" rel="noopener"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-4 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:from-emerald-700 hover:to-teal-700 lg:w-auto">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                                </svg>
                                Download CV (PDF)
                            </a>
                            <p class="text-xs text-stone-500 dark:text-stone-400">Gunakan tombol cetak pada halaman CV
                                untuk menyimpan sebagai PDF.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTIMONI -->
        <section id="testimoni" class="scroll-mt-24 bg-white py-20 dark:bg-stone-950 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center reveal">
                    <span
                        class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300">
                        Testimoni
                    </span>
                    <h2
                        class="mt-4 text-3xl font-black tracking-tight text-stone-900 dark:text-white sm:text-4xl lg:text-5xl">
                        Kata Mereka</h2>
                    <p class="mt-4 text-stone-600 dark:text-stone-400">
                        Kesan dan penilaian dari guru pembimbing, pembimbing lapangan, penguji, dan rekan belajar.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 md:grid-cols-2">
                    @foreach (config('portfolio.testimonials') as $testimonial)
                        <figure
                            class="flex h-full flex-col rounded-[2rem] border border-stone-200 bg-stone-50 p-7 shadow-sm card-hover dark:border-stone-800 dark:bg-stone-900/60 reveal lg:p-8">
                            <svg class="h-8 w-8 text-emerald-500/40" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M7.17 6A5.17 5.17 0 002 11.17V18h6.83v-6.83H5.17A2 2 0 017.17 9V6zm10 0A5.17 5.17 0 0012 11.17V18h6.83v-6.83h-3.66A2 2 0 0117.17 9V6z" />
                            </svg>
                            <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-stone-700 dark:text-stone-300">
                                {{ $testimonial['quote'] }}</blockquote>
                            <figcaption class="mt-5 border-t border-stone-200 pt-4 dark:border-stone-800">
                                <p class="font-black text-stone-900 dark:text-white">{{ $testimonial['name'] }}</p>
                                <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                                    {{ $testimonial['role'] }}</p>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- BLOG -->
        <section id="blog" class="scroll-mt-24 bg-stone-100 py-20 dark:bg-stone-900/50 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center reveal">
                    <span
                        class="inline-flex rounded-full border border-emerald-200 bg-white px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-900 dark:bg-stone-950 dark:text-emerald-300">
                        Blog Pengembang
                    </span>
                    <h2
                        class="mt-4 text-3xl font-black tracking-tight text-stone-900 dark:text-white sm:text-4xl lg:text-5xl">
                        Catatan &amp; Artikel</h2>
                    <p class="mt-4 text-stone-600 dark:text-stone-400">
                        Cerita di balik proyek dan catatan teknis yang saya temui selama ngoding.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 md:grid-cols-2">
                    @foreach (config('portfolio.articles') as $article)
                        <article
                            class="flex h-full flex-col rounded-[2rem] border border-stone-200 bg-white p-7 shadow-sm card-hover dark:border-stone-800 dark:bg-stone-950 reveal lg:p-8">
                            <div class="flex items-center justify-between gap-3">
                                <span
                                    class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">{{ $article['category'] }}</span>
                                <span
                                    class="text-xs font-semibold text-stone-500 dark:text-stone-400">{{ $article['read_time'] }}</span>
                            </div>
                            <h3 class="mt-4 text-xl font-black leading-snug text-stone-900 dark:text-white">
                                {{ $article['title'] }}</h3>
                            <p class="mt-3 flex-1 text-sm leading-relaxed text-stone-600 dark:text-stone-400">
                                {{ $article['excerpt'] }}</p>
                            <div class="mt-5 flex items-center justify-between border-t border-stone-200 pt-4 dark:border-stone-800">
                                <span class="text-xs font-semibold text-stone-500 dark:text-stone-400">Ditulis
                                    {{ $article['date'] }}</span>
                                <span
                                    class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 dark:text-emerald-400">Artikel
                                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- KONTAK -->
        <section id="kontak" class="scroll-mt-24 bg-white py-20 dark:bg-stone-950 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-2xl text-center reveal">
                    <span
                        class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300">
                        Kontak
                    </span>
                    <h2
                        class="mt-4 text-3xl font-black tracking-tight text-stone-900 dark:text-white sm:text-4xl lg:text-5xl">
                        Mari Terhubung</h2>
                    <p class="mt-4 text-stone-600 dark:text-stone-400">
                        Punya masukan, saran, atau peluang kerja sama? Silakan hubungi saya atau isi formulir di bawah
                        ini.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 lg:grid-cols-[0.85fr_1.15fr]">
                    <div class="grid content-start gap-4">
                        <a href="mailto:{{ $contact['email'] }}"
                            class="flex items-center gap-4 rounded-2xl border border-stone-200 bg-stone-50 p-5 transition hover:border-emerald-300 hover:bg-white dark:border-stone-800 dark:bg-stone-900/60 dark:hover:border-emerald-700 dark:hover:bg-stone-900">
                            <span
                                class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">Email</p>
                                <p class="truncate text-sm font-bold text-stone-900 dark:text-white">
                                    {{ $contact['email'] }}</p>
                            </div>
                        </a>

                        <a href="{{ $contact['whatsapp_url'] }}" target="_blank" rel="noopener"
                            class="flex items-center gap-4 rounded-2xl border border-stone-200 bg-stone-50 p-5 transition hover:border-emerald-300 hover:bg-white dark:border-stone-800 dark:bg-stone-900/60 dark:hover:border-emerald-700 dark:hover:bg-stone-900">
                            <span
                                class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.68l1.5 4.5a1 1 0 01-.5 1.2l-2.26 1.13a11 11 0 005.52 5.52l1.13-2.26a1 1 0 011.2-.5l4.5 1.5a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.72 21 3 14.28 3 6V5z" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">WhatsApp</p>
                                <p class="truncate text-sm font-bold text-stone-900 dark:text-white">
                                    {{ $contact['whatsapp'] }}</p>
                            </div>
                        </a>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <a href="{{ $contact['github'] }}" target="_blank" rel="noopener"
                                class="flex items-center gap-3 rounded-2xl border border-stone-200 bg-stone-50 p-4 transition hover:border-emerald-300 hover:bg-white dark:border-stone-800 dark:bg-stone-900/60 dark:hover:border-emerald-700 dark:hover:bg-stone-900">
                                <span class="text-stone-700 dark:text-stone-300">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 2A10 10 0 002 12c0 4.42 2.87 8.17 6.84 9.5.5.09.68-.22.68-.48v-1.7c-2.78.6-3.37-1.34-3.37-1.34-.45-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.52 2.34 1.08 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02a9.56 9.56 0 015 0c1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.85v2.74c0 .27.18.58.69.48A10 10 0 0022 12 10 10 0 0012 2z" />
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">GitHub</p>
                                    <p class="truncate text-sm font-bold text-stone-900 dark:text-white">
                                        {{ $contact['github_handle'] }}</p>
                                </div>
                            </a>

                            <a href="{{ $contact['instagram'] }}" target="_blank" rel="noopener"
                                class="flex items-center gap-3 rounded-2xl border border-stone-200 bg-stone-50 p-4 transition hover:border-emerald-300 hover:bg-white dark:border-stone-800 dark:bg-stone-900/60 dark:hover:border-emerald-700 dark:hover:bg-stone-900">
                                <span class="text-rose-500">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">Instagram</p>
                                    <p class="truncate text-sm font-bold text-stone-900 dark:text-white">
                                        {{ $contact['instagram_handle'] }}</p>
                                </div>
                            </a>
                        </div>

                        <a href="{{ $contact['linkedin'] }}" target="_blank" rel="noopener"
                            class="flex items-center gap-4 rounded-2xl border border-stone-200 bg-stone-50 p-5 transition hover:border-emerald-300 hover:bg-white dark:border-stone-800 dark:bg-stone-900/60 dark:hover:border-emerald-700 dark:hover:bg-stone-900">
                            <span
                                class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-sky-100 text-sky-600 dark:bg-sky-950/60 dark:text-sky-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 9h4v12H3V9zm6 0h3.8v1.64h.05c.53-.95 1.83-1.95 3.77-1.95 4.03 0 4.78 2.5 4.78 5.76V21h-4v-5.75c0-1.37-.03-3.13-1.95-3.13-1.95 0-2.25 1.49-2.25 3.03V21H9V9z" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">LinkedIn</p>
                                <p class="truncate text-sm font-bold text-stone-900 dark:text-white">
                                    {{ $contact['linkedin_handle'] }}</p>
                            </div>
                        </a>

                        <div
                            class="flex items-center gap-4 rounded-2xl border border-stone-200 bg-stone-50 p-5 dark:border-stone-800 dark:bg-stone-900/60">
                            <span
                                class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-stone-200 text-stone-600 dark:bg-stone-800 dark:text-stone-300">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs font-semibold text-stone-500 dark:text-stone-400">Domisili</p>
                                <p class="text-sm font-bold text-stone-900 dark:text-white">{{ $contact['location'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="rounded-[2rem] border border-stone-200 bg-stone-50 p-7 shadow-sm dark:border-stone-800 dark:bg-stone-900/60 reveal lg:p-9">
                        <h3 class="text-xl font-black text-stone-900 dark:text-white">Tinggalkan Pesan / Feedback</h3>
                        <p class="mt-1 text-sm text-stone-600 dark:text-stone-400">Punya masukan, saran, atau peluang
                            kerja sama? Silakan isi formulir di bawah ini.</p>

                        @if (session('success'))
                            <div
                                class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div
                                class="mt-5 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700 dark:border-rose-900 dark:bg-rose-950/50 dark:text-rose-300">
                                <ul class="list-inside list-disc space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('feedback.store') }}" method="POST" class="mt-6 grid gap-5">
                            @csrf

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="name"
                                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Nama
                                        Lengkap</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        placeholder="Masukkan nama Anda..."
                                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                                </div>

                                <div>
                                    <label for="email"
                                        class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        placeholder="nama@domain.com"
                                        class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100" />
                                </div>
                            </div>

                            <div>
                                <label for="category"
                                    class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Kategori</label>
                                <select id="category" name="category"
                                    class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">
                                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih
                                        kategori...</option>
                                    @foreach (config('portfolio.feedback_categories') as $category)
                                        <option value="{{ $category }}"
                                            {{ old('category') === $category ? 'selected' : '' }}>{{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="message"
                                    class="mb-2 block text-sm font-bold text-stone-700 dark:text-stone-200">Pesan /
                                    Feedback</label>
                                <textarea id="message" name="message" rows="5" placeholder="Tuliskan kesan dan saran Anda di sini..."
                                    class="w-full rounded-2xl border border-stone-200 bg-white px-4 py-3.5 text-sm text-stone-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 dark:border-stone-700 dark:bg-stone-950 dark:text-stone-100">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-4 text-sm font-bold text-white shadow-lg shadow-emerald-500/20 transition hover:from-emerald-700 hover:to-teal-700">
                                Kirim Pesan
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-stone-950 text-stone-400">
        <div class="mx-auto max-w-7xl px-5 py-14 lg:px-8">
            <div class="grid gap-10 md:grid-cols-[1.4fr_1fr_1fr]">
                <div>
                    <a href="#beranda" class="flex items-center gap-3">
                        <span
                            class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-sm font-black text-white">{{ $profile['initials'] }}</span>
                        <span class="text-lg font-black text-white">{{ $profile['name'] }}</span>
                    </a>
                    <p class="mt-4 max-w-sm text-sm leading-relaxed">{{ $profile['tagline'] }}. {{ $profile['class'] }}
                        {{ $profile['major'] }}.</p>
                </div>

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-stone-500">Navigasi</p>
                    <ul class="mt-4 grid gap-2 text-sm">
                        <li><a href="#tentang" class="transition hover:text-emerald-400">Tentang</a></li>
                        <li><a href="#keahlian" class="transition hover:text-emerald-400">Keahlian</a></li>
                        <li><a href="#proyek" class="transition hover:text-emerald-400">Proyek</a></li>
                        <li><a href="#blog" class="transition hover:text-emerald-400">Blog</a></li>
                        <li><a href="#kontak" class="transition hover:text-emerald-400">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-stone-500">Terhubung</p>
                    <ul class="mt-4 grid gap-2 text-sm">
                        <li><a href="mailto:{{ $contact['email'] }}"
                                class="transition hover:text-emerald-400">Email</a></li>
                        <li><a href="{{ $contact['github'] }}" target="_blank" rel="noopener"
                                class="transition hover:text-emerald-400">GitHub</a></li>
                        <li><a href="{{ $contact['instagram'] }}" target="_blank" rel="noopener"
                                class="transition hover:text-emerald-400">Instagram</a></li>
                        <li><a href="{{ $contact['linkedin'] }}" target="_blank" rel="noopener"
                                class="transition hover:text-emerald-400">LinkedIn</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="mt-10 flex flex-col gap-3 border-t border-stone-800 pt-6 text-xs sm:flex-row sm:items-center sm:justify-between">
                <p>&copy; {{ date('Y') }} {{ $profile['name'] }}. All rights reserved.</p>
                <p>Dibangun dengan Laravel &amp; Tailwind CSS.</p>
            </div>
        </div>
    </footer>

</body>

</html>
