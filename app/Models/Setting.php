<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function setValue(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => json_encode($value)]
        );
    }

    /**
     * @return Collection<string, mixed>
     */
    public static function decodedValues(): Collection
    {
        return static::query()
            ->pluck('value', 'key')
            ->map(fn (?string $value) => json_decode((string) $value, true))
            ->filter(fn ($value) => $value !== null);
    }
}
