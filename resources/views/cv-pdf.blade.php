@php
    $profile = config('portfolio.profile');
    $contact = config('portfolio.contact');
    $featured = config('portfolio.featured_project');

    $profilePhotoFiles = glob(public_path('image/profile-photo.*')) ?: [];
    $profilePhoto = $profilePhotoFiles ? 'image/'.basename($profilePhotoFiles[0]) : $profile['photo'];

    $photoPath = public_path($profilePhoto);
    $photoSrc = file_exists($photoPath)
        ? 'data:'.mime_content_type($photoPath).';base64,'.base64_encode(file_get_contents($photoPath))
        : null;
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>CV - {{ $profile['name'] }}</title>

    <style>
        @page {
            size: A4;
            margin: 10mm 11mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 8.6pt;
            line-height: 1.4;
            color: #292524;
        }

        h1,
        h2,
        h3,
        p,
        ul {
            margin: 0;
            padding: 0;
        }

        ul {
            list-style: none;
        }

        .header-table {
            width: 100%;
            border-bottom: 1.6pt solid #047857;
            padding-bottom: 3mm;
        }

        .header-table td {
            vertical-align: middle;
        }

        .photo {
            width: 22mm;
            height: 22mm;
            border-radius: 50%;
            border: 1.5pt solid #a7f3d0;
        }

        .name {
            font-size: 18pt;
            font-weight: bold;
            line-height: 1.15;
            color: #1c1917;
        }

        .tagline {
            margin-top: 1mm;
            font-size: 9.4pt;
            font-weight: bold;
            color: #047857;
        }

        .meta {
            margin-top: 0.6mm;
            font-size: 8.4pt;
            color: #78716c;
        }

        .contact {
            margin-top: 2.5mm;
            font-size: 8pt;
            color: #57534e;
        }

        .contact span {
            margin-right: 3mm;
        }

        .contact .icon {
            color: #059669;
            font-weight: bold;
        }

        .section {
            margin-top: 3.6mm;
        }

        .section-title {
            font-size: 8pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1pt;
            color: #047857;
            border-bottom: 0.5pt solid #e7e5e4;
            padding-bottom: 1mm;
            margin-bottom: 1.8mm;
        }

        .layout {
            width: 100%;
            border-collapse: collapse;
        }

        .layout>tbody>tr>td {
            vertical-align: top;
        }

        .col-main {
            width: 62%;
            padding-right: 5mm;
        }

        .col-side {
            width: 38%;
        }

        .item {
            margin-bottom: 2.2mm;
        }

        .item:last-child {
            margin-bottom: 0;
        }

        .item-head {
            width: 100%;
            border-collapse: collapse;
        }

        .item-head td {
            vertical-align: baseline;
        }

        .item-title {
            font-size: 9pt;
            font-weight: bold;
            color: #1c1917;
        }

        .item-period {
            text-align: right;
            font-size: 7.8pt;
            color: #a8a29e;
            white-space: nowrap;
        }

        .item-sub {
            font-size: 8.2pt;
            font-weight: bold;
            color: #059669;
        }

        .item-desc {
            margin-top: 0.6mm;
            font-size: 8.2pt;
            color: #57534e;
            text-align: justify;
        }

        .compact-item {
            margin-bottom: 1.4mm;
        }

        .compact-item .title {
            font-weight: bold;
            color: #1c1917;
        }

        .compact-item .period {
            color: #a8a29e;
            font-size: 7.8pt;
        }

        .chips {
            font-size: 8.2pt;
            color: #44403c;
        }

        .chips .separator {
            color: #d6d3d1;
        }

        .skill-label {
            margin-top: 1.4mm;
            font-size: 7.6pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4pt;
            color: #78716c;
        }

        .footer {
            margin-top: 4mm;
            padding-top: 1.6mm;
            border-top: 0.5pt solid #e7e5e4;
            font-size: 7.4pt;
            color: #a8a29e;
        }

        .footer .right {
            float: right;
        }
    </style>
</head>

<body>

    <table class="header-table">
        <tr>
            <td>
                <p class="name">{{ $profile['name'] }}</p>
                <p class="tagline">{{ $profile['tagline'] }}</p>
                <p class="meta">{{ $profile['class'] }} &middot; {{ $profile['major'] }}</p>
            </td>
            @if ($photoSrc)
                <td width="24mm" align="right">
                    <img src="{{ $photoSrc }}" class="photo" alt="Foto {{ $profile['name'] }}">
                </td>
            @endif
        </tr>
    </table>

    <p class="contact">
        <span><span class="icon">&#9993;</span> {{ $contact['email'] }}</span>
        <span><span class="icon">&#9742;</span> {{ $contact['whatsapp'] }}</span>
        <span><span class="icon">&#8962;</span> {{ $profile['domicile'] }}</span>
        <span><span class="icon">&#9679;</span> {{ $contact['github_handle'] }}</span>
        <span><span class="icon">in</span> {{ $contact['linkedin_handle'] }}</span>
        <span><span class="icon">&#9784;</span> {{ $profile['birth'] }}</span>
    </p>

    <div class="section">
        <p class="section-title">Ringkasan Profil</p>
        <p class="item-desc">{{ config('portfolio.cv_summary') }}</p>
    </div>

    <table class="layout">
        <tr>
            <td class="col-main">
                <div class="section" style="margin-top: 3mm;">
                    <p class="section-title">Pengalaman</p>
                    @foreach (config('portfolio.experiences') as $experience)
                        <div class="item">
                            <table class="item-head">
                                <tr>
                                    <td class="item-title">{{ $experience['title'] }}</td>
                                    <td class="item-period">{{ $experience['period'] }}</td>
                                </tr>
                            </table>
                            <p class="item-sub">{{ $experience['place'] }}</p>
                            <p class="item-desc">{{ $experience['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </td>

            <td class="col-side">
                <div class="section" style="margin-top: 3mm;">
                    <p class="section-title">Pendidikan</p>
                    @foreach (config('portfolio.education') as $item)
                        <div class="compact-item">
                            <p class="title">{{ $item['school'] }}</p>
                            <p class="period">{{ $item['period'] }}</p>
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>

    <div class="section">
        <p class="section-title">Proyek Utama</p>
        <div class="item">
            <table class="item-head">
                <tr>
                    <td class="item-title">{{ $featured['name'] }} &mdash; {{ $featured['subtitle'] }}</td>
                    <td class="item-period">{{ $featured['role'] }}</td>
                </tr>
            </table>
            <p class="item-desc">{{ $featured['description'] }}</p>
            <p class="item-desc"><span style="font-weight:bold;color:#1c1917;">Kontribusi:</span>
                {{ $featured['role_detail'] }}</p>
            <p class="chips" style="margin-top:1mm;">
                @foreach ($featured['technologies'] as $technology)
                    {{ $technology }}@if (!$loop->last)<span class="separator"> &middot; </span>@endif
                @endforeach
            </p>
        </div>
    </div>

    <table class="layout" style="margin-top: 3mm;">
        <tr>
            <td class="col-main">
                <div class="section" style="margin-top: 0;">
                    <p class="section-title">Keahlian</p>
                    <p class="skill-label">Teknis</p>
                    <p class="chips">
                        @foreach (config('portfolio.hard_skills') as $skill)
                            {{ $skill['name'] }}@if (!$loop->last)<span class="separator"> &middot; </span>@endif
                        @endforeach
                    </p>
                    <p class="skill-label">Non-Teknis</p>
                    <p class="chips">
                        @foreach (config('portfolio.soft_skills') as $skill)
                            {{ $skill['name'] }}@if (!$loop->last)<span class="separator"> &middot; </span>@endif
                        @endforeach
                    </p>
                </div>
            </td>

            <td class="col-side">
                <div class="section" style="margin-top: 0;">
                    <p class="section-title">Sertifikasi</p>
                    @foreach ($certificates as $certificate)
                        <div class="compact-item">
                            <p class="title">{{ $certificate['title'] }}</p>
                            <p class="period">{{ $certificate['issuer'] }} &middot; {{ $certificate['year'] }}</p>
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>

    <p class="footer">
        Referensi tersedia berdasarkan permintaan.
        <span class="right">{{ now()->translatedFormat('F Y') }}</span>
    </p>

</body>

</html>
