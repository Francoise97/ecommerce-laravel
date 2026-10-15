@extends('admin.layout')

@section('title', 'Gestion des produits')

@section('content')
<div style="margin-bottom: 20px; text-align: right;">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Ajouter un produit</a>
</div>

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
