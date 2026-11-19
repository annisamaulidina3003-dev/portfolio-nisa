<?php

use App\Models\Certificate;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('tamu tidak dapat mengakses halaman sertifikat', function () {
    $this->get(route('admin.certificates.index'))->assertRedirect(route('login'));
});

test('admin dapat melihat daftar sertifikat', function () {
    $user = User::factory()->admin()->create();
    $certificate = Certificate::create([
        'title' => 'Sertifikat Pengujian',
        'issuer' => 'Lembaga Uji',
        'year' => '2026',
        'icon' => 'badge',
    ]);

    $this->actingAs($user)
        ->get(route('admin.certificates.index'))
        ->assertOk()
        ->assertSee('Sertifikat Pengujian')
        ->assertSee($certificate->issuer);
});

test('admin dapat menambah sertifikat dengan gambar', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->post(route('admin.certificates.store'), [
            'title' => 'Sertifikat Baru',
            'issuer' => 'Lembaga Baru',
            'year' => '2026',
            'icon' => 'trophy',
            'description' => 'Prestasi terbaru.',
            'image' => UploadedFile::fake()->image('sertifikat.jpg'),
        ])
        ->assertRedirect(route('admin.certificates.index'));

    $certificate = Certificate::where('title', 'Sertifikat Baru')->first();

    expect($certificate)->not->toBeNull()
        ->and($certificate->icon)->toBe('trophy')
        ->and($certificate->image)->toStartWith('image/certificates/');

    if ($certificate->image) {
        @unlink(public_path($certificate->image));
    }
});

test('admin dapat mengubah dan menghapus sertifikat', function () {
    $user = User::factory()->admin()->create();
    $certificate = Certificate::create([
        'title' => 'Sertifikat Lama',
        'issuer' => 'Lembaga Lama',
        'year' => '2025',
        'icon' => 'briefcase',
    ]);

    $this->actingAs($user)
        ->get(route('admin.certificates.edit', $certificate))
        ->assertOk()
        ->assertSee('Sertifikat Lama');

    $this->actingAs($user)
        ->put(route('admin.certificates.update', $certificate), [
            'title' => 'Sertifikat Diperbarui',
            'issuer' => 'Lembaga Baru',
            'year' => '2026',
            'icon' => 'badge',
        ])
        ->assertRedirect(route('admin.certificates.index'));

    expect($certificate->fresh()->title)->toBe('Sertifikat Diperbarui');

    $this->actingAs($user)
        ->delete(route('admin.certificates.destroy', $certificate))
        ->assertRedirect(route('admin.certificates.index'));

    expect(Certificate::find($certificate->id))->toBeNull();
});

test('admin dapat membuka halaman konten', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->get(route('admin.content.edit'))
        ->assertOk()
        ->assertSee('Ringkasan CV');
});

test('admin dapat memperbarui konten cv melalui format baris', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->put(route('admin.content.update'), [
            'cv_summary' => 'Ringkasan baru dari pengujian.',
            'education' => "2023 - 2026 | SMK Pengujian | RPL\n2020 - 2023 | SMP Pengujian | -",
            'experiences' => '2025 | Magang Pengujian | PT Uji | Membantu pengembangan aplikasi.',
            'hard_skills' => "Laravel | 90\nPHP | 120",
            'soft_skills' => 'Komunikasi | 80',
        ])
        ->assertRedirect(route('admin.content.edit'));

    $settings = Setting::decodedValues();

    expect($settings['cv_summary'])->toBe('Ringkasan baru dari pengujian.')
        ->and($settings['education'])->toHaveCount(2)
        ->and($settings['education'][0])->toMatchArray([
            'period' => '2023 - 2026',
            'school' => 'SMK Pengujian',
            'description' => 'RPL',
        ])
        ->and($settings['experiences'][0]['title'])->toBe('Magang Pengujian')
        ->and($settings['hard_skills'][1]['level'])->toBe(100)
        ->and($settings['soft_skills'][0]['name'])->toBe('Komunikasi');
});

test('admin dapat memperbarui informasi profil dan kontak', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->put(route('admin.settings.update'), [
            'name' => 'Nama Pengujian',
            'major' => 'Rekayasa Perangkat Lunak',
            'email' => 'profil@example.com',
            'github' => 'https://github.com/pengujian',
            'github_handle' => 'pengujian',
        ])
        ->assertRedirect(route('admin.settings.edit'));

    $settings = Setting::decodedValues();

    expect($settings['profile']['name'])->toBe('Nama Pengujian')
        ->and($settings['contact']['email'])->toBe('profil@example.com')
        ->and($settings['contact']['github_handle'])->toBe('pengujian');
});
