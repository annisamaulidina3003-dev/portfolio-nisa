<?php

use App\Models\Certificate;

test('sertifikat dari database tampil di beranda dan halaman cv', function () {
    Certificate::create([
        'title' => 'Sertifikat Uji Publik',
        'issuer' => 'Lembaga Uji',
        'description' => 'Deskripsi sertifikat uji.',
        'year' => '2026',
        'icon' => 'badge',
        'sort_order' => 99,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Sertifikat Uji Publik');

    $this->get('/cv')
        ->assertOk()
        ->assertSee('Sertifikat Uji Publik')
        ->assertSee('Lembaga Uji');
});

test('sertifikat dari database tampil pada pdf cv', function () {
    Certificate::create([
        'title' => 'Sertifikat PDF Uji',
        'issuer' => 'Lembaga PDF',
        'year' => '2025',
        'icon' => 'trophy',
        'sort_order' => 98,
    ]);

    expect(view('cv-pdf')->render())->toContain('Sertifikat PDF Uji');
});

test('sertifikat yang dihapus dari database tidak tampil di beranda', function () {
    Certificate::query()->delete();

    $this->get('/')
        ->assertOk()
        ->assertDontSee('Sertifikat Praktik Kerja Lapangan (PLK)');
});
