@extends('admin.layout')

@section('title', 'Modifier un produit')

@section('content')
    <div class="card" style="max-width: 700px;">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Nom *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                    style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                @error('name')
                    <div style="color: #d35400; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Description</label>
                <textarea name="description" rows="4"
                    style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">{{ old('description', $product->description) }}</textarea>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Prix (FCFA) *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required
                        style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Ancien prix (promo)</label>
                    <input type="number" name="old_price" value="{{ old('old_price', $product->old_price) }}"
                        style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                        style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Catégorie *</label>
                    <select name="category" required
                        style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                        <option value="Entrée" {{ old('category', $product->category) == 'Entrée' ? 'selected' : '' }}>
                            Entrée</option>
                        <option value="Plat" {{ old('category', $product->category) == 'Plat' ? 'selected' : '' }}>Plat
                        </option>
                        <option value="Dessert" {{ old('category', $product->category) == 'Dessert' ? 'selected' : '' }}>
                            Dessert</option>
                        <option value="Boisson" {{ old('category', $product->category) == 'Boisson' ? 'selected' : '' }}>
                            Boisson</option>
                    </select>
                </div>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Image actuelle</label>
                <div style="margin-bottom: 15px;">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                        style="width: 140px; height: 140px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                </div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Changer l'image (optionnel)</label>
                <input type="file" name="image" accept="image/*"
                    style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px; background: #fafafa;">
                <small style="color: #888; font-size: 12px;">Laissez vide pour conserver l'image actuelle.</small>
            </div>
            <button type="submit" class="btn btn-primary"><span class="material-symbols-outlined">save</span>
                Enregistrer</button>
            <a href="{{ route('admin.products') }}" class="btn btn-secondary"><span
                    class="material-symbols-outlined">cancel</span> Annuler</a>
        </form>
    </div>
@endsection
