@extends('admin.layout')

@section('title', 'Codes promo')

@section('content')
    <div style="margin-bottom: 20px; text-align: right;">
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary"><span
                class="material-symbols-outlined">add</span> Créer un code promo</a>
    </div>

    <div class="card" style="padding: 0; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 15px;">Code</th>
                    <th style="padding: 15px;">Description</th>
                    <th style="padding: 15px;">Réduction</th>
                    <th style="padding: 15px;">Min. panier</th>
                    <th style="padding: 15px;">Expire le</th>
                    <th style="padding: 15px;">Utilisations</th>
                    <th style="padding: 15px;">Statut</th>
                    <th style="padding: 15px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coupons as $coupon)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <span
                                    style="background: #2c3e50

; color: white; padding: 6px 12px; border-radius: 8px; font-weight: 700; letter-spacing: 1px; font-size: 13px;">
                                    {{ $coupon->code }}
                                </span>
                                <button type="button" onclick="copyCode('{{ $coupon->code }}', this)"
                                    title="Copier le code"
                                    style="background: #f0f0f0; border: none; border-radius: 6px; padding: 6px 8px; cursor: pointer; transition: background 0.2s;"
                                    onmouseover="this.style.background='#e0e0e0'"
                                    onmouseout="this.style.background='#f0f0f0'">
                                    <span class="material-symbols-outlined"
                                        style="font-size: 18px; color: #2c3e50

;">content_copy</span>
                                </button>
                            </div>
                        </td>
                        <td style="padding: 12px; color: #666; font-size: 13px;">{{ $coupon->description ?? '—' }}</td>
                        <td style="padding: 12px; color: #d35400; font-weight: 700;">{{ $coupon->formatted_value }}</td>
                        <td style="padding: 12px; font-size: 13px;">{{ number_format($coupon->min_amount, 0, ',', ' ') }}
                            FCFA</td>
                        <td style="padding: 12px; font-size: 13px; color: #666;">
                            {{ $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('d/m/Y') : 'Jamais' }}
                        </td>
                        <td style="padding: 12px; font-size: 13px;">
                            {{ $coupon->used_count }}
                            @if ($coupon->max_uses)
                                / {{ $coupon->max_uses }}
                            @else
                                <span style="color: #888;">/ ∞</span>
                            @endif
                        </td>
                        <td style="padding: 12px;">
                            @if ($coupon->isValid())
                                <span
                                    style="background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"><span
                                        class="material-symbols-outlined" style="font-size: 14px;">check_circle</span>
                                    Actif</span>
                            @else
                                <span
                                    style="background: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"><span
                                        class="material-symbols-outlined" style="font-size: 14px;">block</span>
                                    Inactif</span>
                            @endif
                        </td>
                        <td style="padding: 12px; text-align: right; white-space: nowrap;">
                            <a href="{{ route('admin.coupons.toggle', $coupon->id) }}" class="btn btn-secondary btn-sm"
                                title="{{ $coupon->is_active ? 'Désactiver' : 'Activer' }}">
                                <span class="material-symbols-outlined"
                                    style="font-size: 18px;">{{ $coupon->is_active ? 'toggle_on' : 'toggle_off' }}</span>
                            </a>
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-secondary btn-sm"><span
                                    class="material-symbols-outlined" style="font-size: 16px;">edit</span></a>
                            <a href="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                onclick="return confirm('Supprimer ce code promo ?')" class="btn btn-danger btn-sm"><span
                                    class="material-symbols-outlined" style="font-size: 16px;">delete</span></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding: 40px; text-align: center; color: #888;">
                            <span class="material-symbols-outlined"
                                style="font-size: 40px; color: #ccc; margin-bottom: 10px;">confirmation_number</span><br>
                            Aucun code promo. Créez-en un pour commencer !
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function copyCode(code, btn) {
            navigator.clipboard.writeText(code).then(() => {
                const originalHTML = btn.innerHTML;
                btn.innerHTML =
                    '<span class="material-symbols-outlined" style="font-size: 18px; color: #28a745;">check</span>';
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 1500);
            });
        }
    </script>
@endsection
