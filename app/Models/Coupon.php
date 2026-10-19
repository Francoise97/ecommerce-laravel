<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'min_amount',
        'expires_at',
        'max_uses',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'expires_at' => 'date',
        'is_active' => 'boolean',
        'value' => 'decimal:2',
        'min_amount' => 'decimal:2',
    ];

    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->expires_at && Carbon::parse($this->expires_at)->isPast()) {
            return false;
        }

        if ($this->max_uses !== null && $this->used_count >= $this->max_uses) {
            return false;
        }

        return true;
    }

    public function calculateDiscount($total): float
    {
        if ($total < $this->min_amount) {
            return 0;
        }

        if ($this->type === 'percent') {
            return round($total * ($this->value / 100));
        }

        return min($this->value, $total);
    }

    public function getFormattedValueAttribute(): string
    {
        if ($this->type === 'percent') {
            return '-' . rtrim(rtrim($this->value, '0'), '.') . '%';
        }
        return '-' . number_format($this->value, 0, ',', ' ') . ' FCFA';
    }

    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }
}
