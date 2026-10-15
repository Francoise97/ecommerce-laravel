<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'stock',
        'image',
        'category',
    ];

    // Accesseur : savoir si le produit est en promo
    public function getIsOnPromoAttribute(): bool
    {
        return !is_null($this->old_price) && $this->old_price > $this->price;
    }

    // Accesseur : retourne l'URL complète de l'image
    // Utilisable dans les vues via $product->image_url
    public function getImageUrlAttribute(): string
    {
        // Cas 1 : URL externe (https://...)
        if ($this->image && (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://'))) {
            return $this->image;
        }

        // Cas 2 : Fichier uploadé (ex: products/abc.jpg)
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        // Cas 3 : Aucune image → image par défaut
        return 'https://via.placeholder.com/400x400?text=Pas+d\'image';
    }
}
