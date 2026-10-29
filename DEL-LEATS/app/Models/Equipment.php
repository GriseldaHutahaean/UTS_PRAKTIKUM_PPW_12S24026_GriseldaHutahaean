<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Equipment extends Model
{

    protected $table = 'equipments';

    protected $fillable = [
        'asset_code',
        'category_id',
        'name',
        'specification',
        'condition',
        'status',
        'daily_rental_fee',
        'image_path',
    ];

    protected $casts = [
        'daily_rental_fee' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function loanRequests(): HasMany
    {
        return $this->hasMany(LoanRequest::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function isBorrowable(): bool
    {
        return $this->status === 'tersedia' && $this->condition !== 'rusak_berat';
    }
}
 