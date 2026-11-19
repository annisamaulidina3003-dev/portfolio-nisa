<?php

use App\Models\Certificate;
use App\Models\Portofolio;
use App\Models\User;

test('pengguna bukan admin ditolak saat membuka dashboard admin', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('pengguna bukan admin tidak dapat mengganti atau menghapus foto profil', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('profile.photo.update'))
        ->assertForbidden();

    $this->actingAs($user)
        ->post(route('admin.settings.photo'))
        ->assertForbidden();
});

test('pengguna bukan admin tidak dapat mengubah atau menghapus project dan sertifikat', function () {
    $user = User::factory()->create();
    $project = Portofolio::create([
        'title' => 'Project Terlindungi',
        'description' => 'Tidak boleh diubah.',
        'image' => null,
    ]);
    $certificate = Certificate::create([
        'title' => 'Sertifikat Terlindungi',
        'issuer' => 'Lembaga',
        'year' => '2026',
        'icon' => 'badge',
    ]);

    $this->actingAs($user)
        ->delete(route('portofolios.destroy', $project))
        ->assertForbidden();

    $this->actingAs($user)
        ->delete(route('admin.certificates.destroy', $certificate))
        ->assertForbidden();

    expect(Portofolio::find($project->id))->not->toBeNull()
        ->and(Certificate::find($certificate->id))->not->toBeNull();
});

test('pengguna bukan admin tidak dapat login ke dashboard', function () {
    $user = User::factory()->create([
        'email' => 'pengguna@example.com',
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('admin dapat mengganti foto profil', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->from(route('home'))
        ->post(route('profile.photo.update'))
        ->assertRedirect(route('home'))
        ->assertSessionHasErrors('photo');
});

test('admin dapat menghapus project dan sertifikat', function () {
    $user = User::factory()->admin()->create();
    $project = Portofolio::create([
        'title' => 'Project Admin',
        'description' => 'Boleh dihapus.',
        'image' => null,
    ]);
    $certificate = Certificate::create([
        'title' => 'Sertifikat Admin',
        'issuer' => 'Lembaga',
        'year' => '2026',
        'icon' => 'badge',
    ]);

    $this->actingAs($user)
        ->delete(route('portofolios.destroy', $project))
        ->assertRedirect();

    $this->actingAs($user)
        ->delete(route('admin.certificates.destroy', $certificate))
        ->assertRedirect(route('admin.certificates.index'));

    expect(Portofolio::find($project->id))->toBeNull()
        ->and(Certificate::find($certificate->id))->toBeNull();
});
