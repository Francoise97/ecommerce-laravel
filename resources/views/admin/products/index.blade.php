@extends('admin.layout')

@section('title', 'Gestion des produits')

@section('content')

{{-- Barre de recherche + bouton ajouter --}}
<div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
    <form action="{{ route('admin.products') }}" method="GET" style="display: flex; gap: 10px; flex: 1; max-width: 500px;">
        <input type="text" name="search" placeholder="🔍 Rechercher un produit..."
               value="{{ $search ?? '' }}"
               style="flex: 1; padding: 10px 18px; border: 2px solid #eee; border-radius: 30px; font-size: 14px; outline: none;">
        <select name="category" style="padding: 10px 15px; border: 2px solid #eee; border-radius: 30px; font-size: 14px; outline: none; background: white;">
            <option value="">Toutes catégories</option>
            <option value="Entrée" {{ ($category ?? '') == 'Entrée' ? 'selected' : '' }}>Entrées</option>
            <option value="Plat" {{ ($category ?? '') == 'Plat' ? 'selected' : '' }}>Plats</option>
            <option value="Dessert" {{ ($category ?? '') == 'Dessert' ? 'selected' : '' }}>Desserts</option>
            <option value="Boisson" {{ ($category ?? '') == 'Boisson' ? 'selected' : '' }}>Boissons</option>
        </select>
        <button type="submit" class="btn btn-primary">Rechercher</button>
        @if ($search || $category)
            <a href="{{ route('admin.products') }}" class="btn btn-secondary">✕</a>
        @endif
    </form>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Ajouter un produit</a>
</div>

{{-- Info résultats --}}
@if ($search || $category)
    <div style="background: #e7f3ff; color: #004085; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
        🔍 <strong>{{ $products->count() }}</strong> résultat(s) trouvé(s)
        @if ($search) pour "<strong>{{ $search }}</strong>" @endif
        @if ($category) dans la catégorie "<strong>{{ $category }}</strong>" @endif
    </div>
@endif
<div class="card" style="padding: 0; overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa; text-align: left;">
                <th style="padding: 15px;">Image</th>
                <th style="padding: 15px;">Nom</th>
                <th style="padding: 15px;">Catégorie</th>
                <th style="padding: 15px;">Prix</th>
                <th style="padding: 15px;">Stock</th>
                <th style="padding: 15px; text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                    </td>
                    <td style="padding: 12px; font-weight: 600;">{{ $product->name }}</td>
                    <td style="padding: 12px;">
                        <span style="background: #eee; padding: 4px 10px; border-radius: 12px; font-size: 12px;">{{ $product->category }}</span>
                    </td>
                    <td style="padding: 12px; color: #e94560; font-weight: bold;">
                        {{ number_format($product->price, 0, ',', ' ') }} FCFA
                    </td>
                    <td style="padding: 12px;">{{ $product->stock }}</td>
                    <td style="padding: 12px; text-align: right;">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary btn-sm">✏️ Modifier</a>
                        <a href="{{ route('admin.products.destroy', $product->id) }}" onclick="return confirm('Supprimer ce produit ?')" class="btn btn-danger btn-sm">🗑️</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="padding: 30px; text-align: center; color: #888;">Aucun produit.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
