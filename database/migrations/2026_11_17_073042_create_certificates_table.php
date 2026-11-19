<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issuer')->default('');
            $table->text('description')->nullable();
            $table->string('year')->default('');
            $table->string('icon')->default('badge');
            $table->string('image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();

        $certificates = collect(config('portfolio.certificates', []))
            ->map(fn (array $certificate, int $index) => [
                'title' => $certificate['title'] ?? '',
                'issuer' => $certificate['issuer'] ?? '',
                'description' => $certificate['description'] ?? null,
                'year' => $certificate['year'] ?? '',
                'icon' => $certificate['icon'] ?? 'badge',
                'image' => $certificate['image'] ?? null,
                'sort_order' => $index,
                'created_at' => $now,
                'updated_at' => $now,
            ])
            ->all();

        if ($certificates !== []) {
            DB::table('certificates')->insert($certificates);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
