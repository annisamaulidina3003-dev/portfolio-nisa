@php
    $profile = config('portfolio.profile');
    $navProjectCount = \App\Models\Portofolio::count();
    $navCertificateCount = \App\Models\Certificate::count();
    $navMessageCount = \App\Models\Message::count();

    $navItems = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin.dashboard'), 'icon' => 'grid'],
        ['label' => 'Projects', 'route' => 'admin.projects.index', 'active' => request()->routeIs('admin.projects.*'), 'icon' => 'folder', 'count' => $navProjectCount],
        ['label' => 'Sertifikat', 'route' => 'admin.certificates.index', 'active' => request()->routeIs('admin.certificates.*'), 'icon' => 'badge', 'count' => $navCertificateCount],
        ['label' => 'Pesan Masuk', 'route' => 'admin.messages.index', 'active' => request()->routeIs('admin.messages.*'), 'icon' => 'mail', 'count' => $navMessageCount],
        ['label' => 'Konten', 'route' => 'admin.content.edit', 'active' => request()->routeIs('admin.content.*'), 'icon' => 'pencil'],
        ['label' => 'Pengaturan', 'route' => 'admin.settings.edit', 'active' => request()->routeIs('admin.settings.*'), 'icon' => 'cog'],
    ];
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Dashboard') — Admin {{ $profile['name'] }}</title>

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

<body class="min-h-screen bg-stone-100 text-stone-800 antialiased dark:bg-stone-950 dark:text-stone-100">

    <div class="lg:flex">

        <aside id="admin-menu"
            class="fixed inset-y-0 left-0 z-50 hidden w-72 flex-col overflow-y-auto border-r border-stone-200 bg-white p-5 dark:border-stone-800 dark:bg-stone-900 lg:sticky lg:top-0 lg:flex lg:h-screen lg:shrink-0">
            <button type="button" id="admin-menu-close" aria-label="Tutup menu"
                class="absolute right-3 top-3 grid h-9 w-9 place-items-center rounded-lg border border-stone-200 text-stone-500 dark:border-stone-700 dark:text-stone-400 lg:hidden">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-2 py-2">
                <span
                    class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-sm font-black text-white shadow-lg shadow-emerald-500/25">
                    {{ $profile['initials'] }}
                </span>
                <span class="min-w-0">
                    <span class="block truncate text-sm font-black text-stone-900 dark:text-white">Admin Panel</span>
                    <span class="block truncate text-xs text-stone-500 dark:text-stone-400">{{ $profile['name'] }}</span>
                </span>
            </a>

            <nav class="mt-6 grid gap-1">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold transition
                            {{ $item['active']
                                ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300'
                                : 'text-stone-600 hover:bg-stone-100 dark:text-stone-300 dark:hover:bg-stone-800' }}">
                        <span
                            class="{{ $item['active'] ? 'text-emerald-600 dark:text-emerald-400' : 'text-stone-400 dark:text-stone-500' }}">
                            @switch($item['icon'])
                                @case('grid')
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                    </svg>
                                @break

                                @case('folder')
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                    </svg>
                                @break

                                @case('mail')
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.613a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                @break

                                @case('badge')
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.6 2A9 9 0 1112 3a9 9 0 018.6 6z" />
                                    </svg>
                                @break

                                @case('pencil')
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                @break

                                @default
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.28z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                            @endswitch
                        </span>
                        <span class="flex-1">{{ $item['label'] }}</span>
                        @if (!empty($item['count']))
                            <span
                                class="rounded-full bg-stone-100 px-2 py-0.5 text-xs font-bold text-stone-500 dark:bg-stone-800 dark:text-stone-300">{{ $item['count'] }}</span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto space-y-3 pt-6">
                <a href="{{ route('home') }}"
                    class="flex items-center justify-center gap-2 rounded-xl border border-stone-200 px-4 py-3 text-sm font-semibold text-stone-600 transition hover:border-emerald-300 hover:text-emerald-600 dark:border-stone-700 dark:text-stone-300 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5M10.5 13.5L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Lihat Website
                </a>

                <div
                    class="rounded-2xl border border-stone-200 bg-stone-50 p-4 dark:border-stone-800 dark:bg-stone-950/60">
                    <div class="flex items-center gap-3">
                        <span
                            class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-emerald-100 text-sm font-black text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300">
                            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-bold text-stone-800 dark:text-stone-100">
                                {{ auth()->user()->name }}</p>
                            <p class="truncate text-xs text-stone-500 dark:text-stone-400">{{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit"
                            class="w-full rounded-xl bg-rose-500 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-rose-600">Logout</button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="min-w-0 flex-1">
            <header
                class="sticky top-0 z-40 flex h-16 items-center gap-3 border-b border-stone-200 bg-white/80 px-4 backdrop-blur-xl dark:border-stone-800 dark:bg-stone-950/80 lg:px-8">
                <button type="button" id="admin-menu-toggle" aria-label="Buka menu"
                    class="grid h-10 w-10 place-items-center rounded-xl border border-stone-200 bg-white text-stone-600 dark:border-stone-700 dark:bg-stone-900 dark:text-stone-300 lg:hidden">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-bold text-stone-800 dark:text-stone-100">@yield('heading', 'Dashboard')</p>
                    <p class="truncate text-xs text-stone-500 dark:text-stone-400">@yield('subheading', 'Kelola konten portofolio')</p>
                </div>

                <button type="button" id="theme-toggle" aria-label="Ubah tema"
                    class="grid h-10 w-10 place-items-center rounded-xl border border-stone-200 bg-white text-stone-600 transition hover:border-emerald-300 hover:text-emerald-600 dark:border-stone-700 dark:bg-stone-900 dark:text-stone-300 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
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
            </header>

            <main class="p-4 lg:p-8">
                @if (session('success'))
                    <div data-flash
                        class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700 transition-opacity duration-500 dark:border-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div data-flash
                        class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-bold text-rose-700 transition-opacity duration-500 dark:border-rose-800 dark:bg-rose-950/50 dark:text-rose-300">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.getElementById('admin-menu-toggle')?.addEventListener('click', function() {
            document.getElementById('admin-menu')?.classList.toggle('hidden');
        });

        document.getElementById('admin-menu-close')?.addEventListener('click', function() {
            document.getElementById('admin-menu')?.classList.add('hidden');
        });
    </script>

</body>

</html>
