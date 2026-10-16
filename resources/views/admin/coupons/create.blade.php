@extends('admin.layout')

@section('title', 'Créer un code promo')

@section('content')
<div class="card" style="max-width: 700px;">
    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf

        {{-- Code --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Code *</label>
            <input type="text" name="code" value="{{ old('code') }}" required maxlength="50"
                   placeholder="Ex: BIENVENUE10"
                   style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">
            <small style="color: #888; font-size: 12px;">Le code sera automatiquement mis en majuscules.</small>
            @error('code') <div style="color: #e94560; font-size: 13px; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        {{-- Description --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Description</label>
            <input type="text" name="description" value="{{ old('description') }}" maxlength="255"
                   placeholder="Ex: Réduction de bienvenue"
                   style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
        </div>

        {{-- Type + Valeur --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Type de réduction *</label>
                <select name="type" id="type" required
                        style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;"
                        onchange="updateValueLabel()">
                    <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Pourcentage (%)</option>
                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Montant fixe (FCFA)</option>
                </select>
            </div>
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">
                    <span id="value-label">Valeur en % *</span>
                </label>
                <input type="number" name="value" value="{{ old('value') }}" required min="0.01" step="0.01"
                       style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                @error('value') <div style="color: #e94560; font-size: 13px; margin-top: 5px;">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Montant minimum + Date d'expiration --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Montant minimum du panier (FCFA)</label>
                <input type="number" name="min_amount" value="{{ old('min_amount', 0) }}" min="0"
                       style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                <small style="color: #888; font-size: 12px;">0 = pas de minimum.</small>
            </div>
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Date d'expiration</label>
                <input type="date" name="expires_at" value="{{ old('expires_at') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                       style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
                <small style="color: #888; font-size: 12px;">Laisser vide = jamais.</small>
            </div>
        </div>

        {{-- Nombre max d'utilisations --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Nombre maximum d'utilisations</label>
            <input type="number" name="max_uses" value="{{ old('max_uses') }}" min="1"
                   placeholder="Laisser vide = illimité"
                   style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px;">
        </div>

        {{-- Actif --}}
        <div style="margin-bottom: 20px;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                       style="width: 20px; height: 20px; cursor: pointer;">
                <span style="font-weight: 600;">Activer immédiatement</span>
            </label>
        </div>

        {{-- Boutons --}}
        <button type="submit" class="btn btn-primary">✅ Créer le code promo</button>
        <a href="{{ route('admin.coupons') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script>
function updateValueLabel() {
    const type = document.getElementById('type').value;
    const label = document.getElementById('value-label');
    label.textContent = (type === 'percent') ? 'Valeur en % *' : 'Valeur en FCFA *';
}
updateValueLabel();
</script>
@endsection
