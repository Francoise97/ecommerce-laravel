@extends('admin.layout')

@section('title', 'Ajouter un produit')

@section('content')
<div class="card" style="max-width: 700px;">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nom --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Nom *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
            @error('name')
                <div style="color: #e94560; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Description</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">{{ old('description') }}</textarea>
        </div>

        {{-- Prix + Ancien prix --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Prix (FCFA) *</label>
                <input type="number" name="price" value="{{ old('price') }}" required
                       style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                @error('price')
                    <div style="color: #e94560; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Ancien prix (promo)</label>
                <input type="number" name="old_price" value="{{ old('old_price') }}"
                       style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                @error('old_price')
                    <div style="color: #e94560; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Stock + Catégorie --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Stock *</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" required
                       style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                @error('stock')
                    <div style="color: #e94560; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Catégorie *</label>
                <select name="category" required
                        style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                    <option value="Entrée" {{ old('category') == 'Entrée' ? 'selected' : '' }}>Entrée</option>
                    <option value="Plat" {{ old('category', 'Plat') == 'Plat' ? 'selected' : '' }}>Plat</option>
                    <option value="Dessert" {{ old('category') == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                    <option value="Boisson" {{ old('category') == 'Boisson' ? 'selected' : '' }}>Boisson</option>
                </select>
                @error('category')
                    <div style="color: #e94560; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Image (upload) --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Image du produit</label>
            <input type="file" name="image" accept="image/*"
                   style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px; background: #fafafa;">
            <small style="color: #888; font-size: 12px;">Formats acceptés : JPG, PNG, GIF, WEBP — Max 2 Mo</small>
            @error('image')
                <div style="color: #e94560; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Boutons --}}
        <button type="submit" class="btn btn-primary">✅ Ajouter le produit</button>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
