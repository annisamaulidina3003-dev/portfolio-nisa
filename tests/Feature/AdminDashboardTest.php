<?php

use App\Models\Message;
use App\Models\Portofolio;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('tamu diarahkan ke login saat membuka dashboard admin', function () {
    $this->get('/admin')->assertRedirect(route('login'));
});

test('pengguna login dapat membuka dashboard admin', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertSee($user->name);
});

test('pengguna login dapat menambah project dari dashboard', function () {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->post(route('admin.projects.store'), [
            'title' => 'Project Dashboard',
            'description' => 'Dibuat dari dashboard admin.',
            'image' => UploadedFile::fake()->image('project.jpg'),
        ])
        ->assertRedirect(route('admin.projects.index'));

    expect(Portofolio::where('title', 'Project Dashboard')->exists())->toBeTrue();
});

test('pengguna login dapat menghapus project dari dashboard', function () {
    $user = User::factory()->admin()->create();
    $project = Portofolio::create([
        'title' => 'Project Lama',
        'description' => 'Akan dihapus.',
        'image' => null,
    ]);

    $this->actingAs($user)
        ->delete(route('admin.projects.destroy', $project))
        ->assertRedirect(route('admin.projects.index'));

    expect(Portofolio::find($project->id))->toBeNull();
});

test('pengguna login dapat melihat dan menghapus pesan', function () {
    $user = User::factory()->admin()->create();
    $message = Message::create([
        'name' => 'Penguji',
        'email' => 'penguji@example.com',
        'category' => 'Penguji UKK',
        'message' => 'Pesan uji coba.',
    ]);

    $this->actingAs($user)
        ->get(route('admin.messages.show', $message))
        ->assertOk()
        ->assertSee('Pesan uji coba.');

    $this->actingAs($user)
        ->delete(route('admin.messages.destroy', $message))
        ->assertRedirect(route('admin.messages.index'));

    expect(Message::find($message->id))->toBeNull();
});

test('login mengarahkan pengguna ke dashboard admin', function () {
    $user = User::factory()->admin()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect(route('admin.dashboard'));
});
