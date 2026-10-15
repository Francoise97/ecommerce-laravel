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

    // Vérifier si le coupon est encore valide
    public function isValid(): bool
    {
        // Inactif ?
        if (!$this->is_active) {
            return false;
        }

        // Expiré ?
        if ($this->expires_at && Carbon::parse($this->expires_at)->isPast()) {
            return false;
        }

        // Nombre d'utilisations atteint ?
        if ($this->max_uses !== null && $this->used_count >= $this->max_uses) {
            return false;
        }

        return true;
    }

    // Calculer la réduction selon le type (% ou FCFA fixe)
    public function calculateDiscount($total): float
    {
        // Vérifier le montant minimum
        if ($total < $this->min_amount) {
            return 0;
        }

        if ($this->type === 'percent') {
            return round($total * ($this->value / 100));
        }

        // Type 'fixed' : réduction en FCFA
        // Ne pas dépasser le total (éviter un total négatif)
        return min($this->value, $total);
    }

    // Afficher joliment la valeur (ex: "-10%" ou "-2 000 FCFA")
    public function getFormattedValueAttribute(): string
    {
        if ($this->type === 'percent') {
            return '-' . rtrim(rtrim($this->value, '0'), '.') . '%';
        }
        return '-' . number_format($this->value, 0, ',', ' ') . ' FCFA';
    }

    // Incrémenter le compteur d'utilisations
    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }
}
