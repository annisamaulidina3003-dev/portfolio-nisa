<?php

return [

    'profile' => [
        'name' => 'Annisa Maulidina',
        'initials' => 'AM',
        'class' => 'XII PPLG',
        'major' => 'Pengembangan Perangkat Lunak dan Gim (RPL)',
        'tagline' => 'Junior Full-Stack Web Developer & Creative Problem Solver',
        'roles' => [
            'Junior Full-Stack Web Developer',
            'Creative Problem Solver',
            'Laravel & Tailwind CSS Enthusiast',
        ],
        'description' => 'Halo! Saya adalah seorang pengembang web muda yang berfokus pada pembangunan aplikasi modern, responsif, dan solutif. Berpengalaman dalam ekosistem Laravel dan Tailwind CSS untuk menciptakan pengalaman digital yang optimal.',
        'skills' => ['Laravel Framework', 'PHP', 'MySQL', 'Tailwind CSS', 'RESTful API'],
        'photo' => 'image/nicaaaa.jpeg',
        'status' => 'Siswa SMK Aktif / Calon Lulusan 2027',
        'birth' => 'Jakarta, [30 Maret 2007]',
        'domicile' => 'Banjarmasin, Kalimantan Selatan',
        'career_goal' => 'Menjadi seorang Professional Software Engineer / Backend Developer yang mampu membangun infrastruktur aplikasi berskala besar, efisien, dan bermanfaat bagi masyarakat luas.',
    ],

    'about' => [
        'interests' => [
            'Web Development',
            'Backend Engineering',
            'Relational Database Architecture',
            'UI/UX Implementation',
        ],
        'technologies' => [
            'PHP (Laravel)',
            'JavaScript',
            'HTML5 / CSS3',
            'MySQL',
            'Git & GitHub',
        ],
    ],

    'education' => [
        [
            'period' => '2024 – Sekarang',
            'school' => 'SMK Negeri 2 Banjarmasin',
            'description' => 'Kompetensi Keahlian Pengembangan Perangkat Lunak dan Gim (PPLG).',
            'current' => true,
        ],
        [
            'period' => '2021 – 2024',
            'school' => 'SMP Negeri 31 Banjarmasin',
            'description' => 'Sekolah Menengah Pertama.',
            'current' => false,
        ],
        [
            'period' => '2020 – 2021',
            'school' => 'SDN Sungai Miai 2',
            'description' => 'Sekolah Dasar.',
            'current' => false,
        ],
        [
            'period' => '2019 – 2020',
            'school' => 'SDN Semangat Dalam 3',
            'description' => 'Sekolah Dasar.',
            'current' => false,
        ],
        [
            'period' => '2017 – 2018',
            'school' => 'MI All-Ittihad',
            'description' => 'Madrasah Ibtidaiyah.',
            'current' => false,
        ],
        [
            'period' => '2015 – 2017',
            'school' => 'SDIT Nurul Ikhsan',
            'description' => 'Sekolah Dasar Islam Terpadu.',
            'current' => false,
        ],
    ],

    'organization' => [
        'period' => '2024 – 2025',
        'role' => 'Anggota Divisi IT & Humas',
        'place' => 'Ekstrakurikuler Coding / Komputer Sekolah',
        'description' => 'Mengelola publikasi dan dokumentasi kegiatan internal, serta membantu sesi pembekalan dasar pemrograman untuk adik kelas.',
    ],

    'internship' => [
        'period' => '3 – 6 Bulan',
        'role' => 'Web Developer Intern',
        'place' => '[Nama Perusahaan / Instansi PLK]',
        'description' => 'Mengembangkan modul pengolahan data inventaris internal menggunakan framework Laravel dan MySQL.',
    ],

    'hard_skills' => [
        ['name' => 'PHP & Laravel Framework', 'level' => 85],
        ['name' => 'MySQL & Database Management', 'level' => 80],
        ['name' => 'HTML, CSS & Tailwind CSS', 'level' => 90],
        ['name' => 'JavaScript (Basic & DOM)', 'level' => 75],
        ['name' => 'REST API Integration', 'level' => 70],
        ['name' => 'Git & GitHub (Version Control)', 'level' => 80],
    ],

    'soft_skills' => [
        ['name' => 'Problem Solving & Debugging', 'level' => 85],
        ['name' => 'Manajemen Waktu & Tenggat Waktu', 'level' => 85],
        ['name' => 'Kerja Sama Tim (Teamwork)', 'level' => 90],
        ['name' => 'Komunikasi & Presentasi', 'level' => 80],
        ['name' => 'Kemampuan Adaptasi Teknologi Baru', 'level' => 90],
    ],

    'featured_project' => [
        'name' => 'EduProject Hub',
        'subtitle' => 'Platform Portofolio & Uji Kompetensi Keahlian',
        'description' => 'Web platform interaktif berbasis Laravel yang dirancang untuk mengelola portofolio karya siswa secara terpusat serta menyediakan dashboard pengujian untuk penguji UKK.',
        'problems' => [
            'Pendokumentasian karya siswa selama sekolah sering kali tercecer dan tidak terstruktur.',
            'Penguji kesulitan melihat secara menyeluruh hasil karya dan dokumentasi teknis siswa secara real-time.',
        ],
        'goals' => [
            'Menyediakan wadah digital yang profesional untuk menampilkan kemampuan teknis siswa kepada pihak industri / penguji UKK.',
            'Mempermudah pengelolaan konten portofolio melalui Dashboard Admin berbasis CRUD.',
        ],
        'technologies' => ['Laravel 11', 'Blade Engine', 'Tailwind CSS', 'MySQL', 'Alpine.js', 'FontAwesome'],
        'role' => 'Full-Stack Developer',
        'role_detail' => 'Merancang ERD database, slice UI, hingga implementasi logic CRUD dan autentikasi.',
        'features' => [
            'Multi-role Authentication (Admin & Pengunjung)',
            'Dynamic Portfolio Management (CRUD Proyek & Sertifikat)',
            'Dark / Light Theme Switching',
            'Formulir Pesan & Feedback Interaktif',
            'Filter Proyek Berdasarkan Kategori / Teknologi',
        ],
        'demo_url' => 'https://demo-portfolio-ukk.test',
        'source_url' => 'https://github.com/usernamekamu/portfolio-laravel-ukk',
        'process' => [
            'Perancangan wireframe UI & ERD Database di MySQL.',
            'Setup Framework Laravel & integrasi UI dengan Tailwind CSS.',
            'Pembuatan fitur Authentication, Controller CRUD, dan File Upload.',
            'Testing bug, optimasi query, dan responsive layout testing.',
        ],
        'detail' => 'Memiliki lebih dari 8 tabel database terintegrasi dengan validasi input yang ketat untuk mencegah SQL Injection dan CSRF.',
        'feedback' => 'Tampilan aplikasi sangat bersih dan panel admin sangat responsif serta mudah digunakan.',
    ],

    'certificates' => [
        [
            'title' => 'Sertifikat Praktik Kerja Lapangan (PLK)',
            'issuer' => '[Toko Bagas / Atk Banjarmasin]',
            'description' => 'Lulus predikat Sangat Baik sebagai Web Developer Intern (2025).',
            'year' => '2025',
            'icon' => 'briefcase',
            'image' => 'image/sertifikat-magang.jpeg',
        ],
        [
            'title' => 'Sertifikat Uji Kompetensi Keahlian (UKK) / BNSP',
            'issuer' => 'SMK Negeri 2 Banjarmasin & Dunia Industri Pasangan',
            'description' => 'Sertifikasi kemampuan pemrograman web berstandar industri (2026).',
            'year' => '2026',
            'icon' => 'badge',
        ],
        [
            'title' => 'Juara / Peserta Lomba Coding & Web Design',
            'issuer' => '[Nama Event / Penyelenggara]',
            'description' => 'Pengembang Aplikasi Terbaik Kategori Siswa (2025).',
            'year' => '2025',
            'icon' => 'trophy',
        ],
    ],

    'experiences' => [
        [
            'period' => '2025 · 3 – 6 Bulan',
            'title' => 'Web Developer Intern (PLK)',
            'place' => '[Nama Perusahaan]',
            'description' => 'Mengembangkan modul laporan berbasis Laravel dan MySQL, meliputi perancangan struktur tabel, fitur CRUD, validasi input, serta perbaikan bug pada sistem internal.',
        ],
        [
            'period' => '2024 – 2025',
            'title' => 'Panitia IT & Teknis',
            'place' => 'Ekstrakurikuler Komputer SMK',
            'description' => 'Mengelola media digital dan dokumentasi seluruh event sekolah, sekaligus menjadi instruktur sesi dasar pemrograman web untuk siswa kelas X.',
        ],
        [
            'period' => '2025',
            'title' => 'Peserta Lomba Web Development',
            'place' => '[Nama Event / Universitas / Instansi]',
            'description' => 'Membangun prototipe landing page solutif dari nol dalam tenggat 24 jam, mencakup perancangan UI dan implementasi front-end responsif.',
        ],
    ],

    'testimonials' => [
        [
            'quote' => 'Siswa ini menunjukkan pemahaman struktur logika backend yang sangat rapi di Laravel. Proyek portofolionya memenuhi seluruh kriteria UKK dengan kualitas yang sangat memuaskan.',
            'name' => '[Nama Guru Pembimbing, S.Kom.]',
            'role' => 'Guru Pembimbing UKK',
        ],
        [
            'quote' => 'Selama menjalani PLK, ybs sangat cepat beradaptasi dengan alur kerja tim, disiplin, dan mampu menyelesaikan tugas pembuatan modul CRUD tepat waktu.',
            'name' => '[Nama Pembimbing Lapangan]',
            'role' => 'Lead Developer di [Nama Perusahaan]',
        ],
        [
            'quote' => 'Navigasi web portofolio ini sangat intuitif. Fitur dark mode dan galeri proyeknya sangat informatif menampilkan proses kerja nyata.',
            'name' => '[Nama Penguji UKK / Industri]',
            'role' => 'Penguji UKK',
        ],
        [
            'quote' => 'Rekan tim yang solid, selalu siap membantu menangani error / bug codingan saat kerja kelompok.',
            'name' => '[Nama Teman Sekelas]',
            'role' => 'Teman Sekelas',
        ],
    ],

    'articles' => [
        [
            'title' => 'Dibalik Layar Pembangunan Portfolio Laravel untuk UKK 2026',
            'excerpt' => 'Artikel ini menceritakan perjalanan dari menentukan struktur database, memilih Tailwind CSS sebagai framework UI, hingga mengatasi kendala keterhubungan relasi Eloquent ORM di Laravel selama pengerjaan tugas UKK.',
            'category' => 'Cerita Proyek',
            'read_time' => '6 menit baca',
            'date' => '2026',
        ],
        [
            'title' => 'Solusi Mengatasi Migration Error & CSRF Token Mismatch pada Laravel',
            'excerpt' => 'Catatan ngoding sederhana yang merangkum kendala teknis yang sering ditemui saat deployment proyek web dan langkah-langkah solutif penyelesaiannya.',
            'category' => 'Troubleshooting',
            'read_time' => '4 menit baca',
            'date' => '2026',
        ],
    ],

    'cv_summary' => 'Siswa XII PPLG (RPL) SMK Negeri 2 Banjarmasin yang berfokus pada pengembangan aplikasi web full-stack. Terbiasa membangun aplikasi Laravel secara end-to-end: analisis kebutuhan, perancangan basis data relasional, implementasi CRUD dan autentikasi, hingga antarmuka responsif dengan Tailwind CSS. Disiplin, cepat beradaptasi dengan teknologi baru, dan siap berkontribusi dalam tim pengembangan produk.',

    'contact' => [
        'email' => 'annisamaulidina3003@gmail.com',
        'whatsapp' => '+62 877-8455-4753',
        'whatsapp_url' => 'https://wa.me/6287784554753',
        'github' => 'https://github.com/annisamaulidina3003-dev',
        'github_handle' => '@annisamaulidina3003-dev',
        'instagram' => 'https://instagram.com/anmldnalghm',
        'instagram_handle' => '@anmldnalghm',
        'linkedin' => 'https://linkedin.com/in/usernamekamu',
        'linkedin_handle' => 'in/usernamekamu',
        'location' => 'Banjarmasin, Kalimantan Selatan',
    ],

    'feedback_categories' => [
        'Penguji UKK',
        'Guru',
        'Teman',
        'Dunia Industri',
    ],

];
