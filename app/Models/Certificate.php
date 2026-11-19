<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'description',
        'year',
        'icon',
        'image',
        'sort_order',
    ];

    /**
     * @return array{title: string, issuer: string, description: ?string, year: string, icon: string, image: ?string}
     */
    public function toPortfolioArray(): array
    {
        return [
            'title' => $this->title,
            'issuer' => $this->issuer,
            'description' => $this->description,
            'year' => $this->year,
            'icon' => $this->icon,
            'image' => $this->image,
        ];
    }
}
