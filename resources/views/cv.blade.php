@php
    $profile = config('portfolio.profile');
    $contact = config('portfolio.contact');
    $featured = config('portfolio.featured_project');

    $profilePhotoFiles = glob(public_path('image/profile-photo.*')) ?: [];
    $profilePhoto = $profilePhotoFiles ? 'image/'.basename($profilePhotoFiles[0]) : $profile['photo'];
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV - {{ $profile['name'] }}</title>

    @vite('resources/css/app.css')

    <style>
        .cv-sheet {
            width: 210mm;
            max-width: 100%;
        }

        @media print {
            @page {
                size: A4;
                margin: 10mm 11mm;
            }

            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print {
                display: none !important;
            }

            body {
                background: #fff !important;
                font-size: 9pt;
            }

            .cv-sheet {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                border: 0 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
            }

            .cv-section {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .cv-item {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body class="bg-stone-100 text-stone-800 antialiased">

    <div class="no-print fixed top-5 right-5 z-50 flex items-center gap-2">
        <a href="{{ route('home') }}"
            class="rounded-xl border border-stone-300 bg-white px-4 py-2.5 text-sm font-semibold text-stone-700 shadow-sm transition hover:bg-stone-50">
            Kembali
        </a>
        <button type="button" onclick="window.print()"
            class="rounded-xl border border-stone-300 bg-white px-4 py-2.5 text-sm font-semibold text-stone-700 shadow-sm transition hover:bg-stone-50">
            Cetak
        </button>
        <a href="{{ route('cv.download') }}"
            class="rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
            Download PDF
        </a>
    </div>

    <main class="mx-auto px-4 py-10 print:p-0">
        <article class="cv-sheet mx-auto rounded-2xl border border-stone-200 bg-white p-8 shadow-xl">

            <header class="flex items-center justify-between gap-6 border-b-2 border-emerald-600 pb-4">
                <div class="min-w-0">
                    <h1 class="text-2xl font-black leading-tight tracking-tight text-stone-900">{{ $profile['name'] }}</h1>
                    <p class="mt-0.5 text-sm font-bold text-emerald-700">{{ $profile['tagline'] }}</p>
                    <p class="mt-0.5 text-xs text-stone-500">{{ $profile['class'] }} · {{ $profile['major'] }}</p>
                </div>
                <img src="{{ asset($profilePhoto) }}" alt="Foto {{ $profile['name'] }}"
                    class="h-20 w-20 shrink-0 rounded-full border-4 border-emerald-100 object-cover shadow-sm">
            </header>

            <div class="mt-3 grid gap-x-6 gap-y-1 text-xs text-stone-600 sm:grid-cols-2 lg:grid-cols-3">
                <a href="mailto:{{ $contact['email'] }}"
                    class="flex items-center gap-1.5 hover:text-emerald-600">
                    <span class="font-bold text-emerald-600">@</span>
                    <span class="truncate">{{ $contact['email'] }}</span>
                </a>
                <a href="{{ $contact['whatsapp_url'] }}" target="_blank" rel="noopener"
                    class="flex items-center gap-1.5 hover:text-emerald-600">
                    <span class="font-bold text-emerald-600">Tel</span>
                    <span>{{ $contact['whatsapp'] }}</span>
                </a>
                <p class="flex items-center gap-1.5">
                    <span class="font-bold text-emerald-600">Lok</span>
                    <span>{{ $profile['domicile'] }}</span>
                </p>
                <a href="{{ $contact['github'] }}" target="_blank" rel="noopener"
                    class="flex items-center gap-1.5 hover:text-emerald-600">
                    <span class="font-bold text-emerald-600">Git</span>
                    <span class="truncate">{{ $contact['github_handle'] }}</span>
                </a>
                <a href="{{ $contact['linkedin'] }}" target="_blank" rel="noopener"
                    class="flex items-center gap-1.5 hover:text-emerald-600">
                    <span class="font-bold text-emerald-600">In</span>
                    <span class="truncate">{{ $contact['linkedin_handle'] }}</span>
                </a>
                <p class="flex items-center gap-1.5">
                    <span class="font-bold text-emerald-600">Lhr</span>
                    <span>{{ $profile['birth'] }}</span>
                </p>
            </div>

            <section class="cv-section mt-4">
                <h2 class="border-b border-stone-200 pb-1 text-[11px] font-black uppercase tracking-[0.16em] text-emerald-700">
                    Ringkasan Profil</h2>
                <p class="mt-1.5 text-justify text-xs leading-relaxed text-stone-600">{{ config('portfolio.cv_summary') }}
                </p>
            </section>

            <div class="mt-4 grid gap-6 lg:grid-cols-[1.55fr_1fr]">
                <div class="space-y-4">
                    <section class="cv-section">
                        <h2
                            class="border-b border-stone-200 pb-1 text-[11px] font-black uppercase tracking-[0.16em] text-emerald-700">
                            Pengalaman</h2>
                        <div class="mt-2 space-y-2.5">
                            @foreach (config('portfolio.experiences') as $experience)
                                <div class="cv-item">
                                    <div class="flex items-baseline justify-between gap-3">
                                        <p class="text-sm font-bold text-stone-900">{{ $experience['title'] }}</p>
                                        <p class="shrink-0 text-[11px] text-stone-400">{{ $experience['period'] }}</p>
                                    </div>
                                    <p class="text-xs font-semibold text-emerald-600">{{ $experience['place'] }}</p>
                                    <p class="mt-0.5 text-justify text-xs leading-relaxed text-stone-600">
                                        {{ $experience['description'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="cv-section">
                        <h2
                            class="border-b border-stone-200 pb-1 text-[11px] font-black uppercase tracking-[0.16em] text-emerald-700">
                            Proyek Utama</h2>
                        <div class="cv-item mt-2">
                            <div class="flex items-baseline justify-between gap-3">
                                <p class="text-sm font-bold text-stone-900">{{ $featured['name'] }} —
                                    {{ $featured['subtitle'] }}</p>
                                <p class="shrink-0 text-[11px] text-stone-400">{{ $featured['role'] }}</p>
                            </div>
                            <p class="mt-0.5 text-justify text-xs leading-relaxed text-stone-600">
                                {{ $featured['description'] }}</p>
                            <p class="mt-1 text-justify text-xs leading-relaxed text-stone-600">
                                <span class="font-semibold text-stone-800">Kontribusi:</span>
                                {{ $featured['role_detail'] }}</p>
                            <p class="mt-1.5 text-[11px] text-stone-500">
                                {{ implode(' · ', $featured['technologies']) }}</p>
                        </div>
                    </section>
                </div>

                <div class="space-y-4">
                    <section class="cv-section">
                        <h2
                            class="border-b border-stone-200 pb-1 text-[11px] font-black uppercase tracking-[0.16em] text-emerald-700">
                            Pendidikan</h2>
                        <div class="mt-2 space-y-1.5">
                            @foreach (config('portfolio.education') as $item)
                                <div>
                                    <p class="text-xs font-bold text-stone-900">{{ $item['school'] }}</p>
                                    <p class="text-[11px] text-stone-400">{{ $item['period'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="cv-section">
                        <h2
                            class="border-b border-stone-200 pb-1 text-[11px] font-black uppercase tracking-[0.16em] text-emerald-700">
                            Keahlian</h2>
                        <p class="mt-2 text-[10px] font-bold uppercase tracking-wider text-stone-400">Teknis</p>
                        <p class="mt-0.5 text-[11px] leading-relaxed text-stone-600">
                            {{ implode(' · ', array_column(config('portfolio.hard_skills'), 'name')) }}</p>
                        <p class="mt-2 text-[10px] font-bold uppercase tracking-wider text-stone-400">Non-Teknis</p>
                        <p class="mt-0.5 text-[11px] leading-relaxed text-stone-600">
                            {{ implode(' · ', array_column(config('portfolio.soft_skills'), 'name')) }}</p>
                    </section>

                    <section class="cv-section">
                        <h2
                            class="border-b border-stone-200 pb-1 text-[11px] font-black uppercase tracking-[0.16em] text-emerald-700">
                            Sertifikasi</h2>
                        <div class="mt-2 space-y-1.5">
                            @foreach ($certificates as $certificate)
                                <div>
                                    <p class="text-xs font-bold leading-snug text-stone-900">{{ $certificate['title'] }}
                                    </p>
                                    <p class="text-[11px] text-stone-400">{{ $certificate['issuer'] }} ·
                                        {{ $certificate['year'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>

            <footer class="mt-4 flex items-center justify-between border-t border-stone-200 pt-2 text-[10px] text-stone-400">
                <span>Referensi tersedia berdasarkan permintaan.</span>
                <span>{{ now()->translatedFormat('F Y') }}</span>
            </footer>

        </article>
    </main>

</body>

</html>
