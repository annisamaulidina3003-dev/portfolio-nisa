<?php

use App\Models\Message;
use App\Models\Portofolio;
use App\Models\User;

test('halaman beranda menampilkan konten portofolio', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Annisa Maulidina')
        ->assertSee('EduProject Hub')
        ->assertSee('Galeri Karya Lainnya');
});

test('halaman cv dapat diakses', function () {
    $this->get('/cv')
        ->assertOk()
        ->assertSee('Ringkasan')
        ->assertSee('Annisa Maulidina');
});

test('project yang tersimpan tampil pada galeri', function () {
    Portofolio::create([
        'title' => 'Proyek Uji Coba',
        'description' => 'Deskripsi proyek uji coba.',
        'image' => null,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Proyek Uji Coba');
});

test('formulir feedback menyimpan pesan', function () {
    $this->post('/feedback', [
        'name' => 'Penguji UKK',
        'email' => 'penguji@example.com',
        'category' => 'Penguji UKK',
        'message' => 'Tampilan portofolio sangat rapi dan mudah digunakan.',
    ])->assertRedirect(route('home').'#kontak');

    $this->assertDatabaseHas('messages', [
        'name' => 'Penguji UKK',
        'email' => 'penguji@example.com',
        'category' => 'Penguji UKK',
    ]);
});

test('formulir feedback memvalidasi input', function () {
    $this->post('/feedback', [
        'name' => '',
        'email' => 'bukan-email',
        'category' => 'Kategori Tidak Ada',
        'message' => '',
    ])->assertSessionHasErrors(['name', 'email', 'category', 'message']);

    expect(Message::count())->toBe(0);
});

test('pengguna yang login dapat logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/logout')
        ->assertRedirect('/');

    $this->assertGuest();
});

test('foto profil harus berupa file gambar', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->post('/profile/photo', ['photo' => 'bukan-gambar'])
        ->assertSessionHasErrors('photo');
});
