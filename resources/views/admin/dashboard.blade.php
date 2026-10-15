@extends('admin.layout')

@section('title', 'Tableau de bord')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="card" style="border-left: 4px solid #e94560;">
        <div style="color: #888; font-size: 13px; margin-bottom: 5px;">CA total</div>
        <div style="font-size: 26px; font-weight: bold; color: #1a1a2e;">{{ number_format($stats['total_revenue'], 0, ',', ' ') }} FCFA</div>
    </div>
    <div class="card" style="border-left: 4px solid #28a745;">
        <div style="color: #888; font-size: 13px; margin-bottom: 5px;">Commandes</div>
        <div style="font-size: 26px; font-weight: bold; color: #1a1a2e;">{{ $stats['total_orders'] }}</div>
        <div style="color: #e94560; font-size: 12px; margin-top: 5px;">⏳ {{ $stats['pending_orders'] }} en attente</div>
    </div>
    <div class="card" style="border-left: 4px solid #ffc107;">
        <div style="color: #888; font-size: 13px; margin-bottom: 5px;">Produits</div>
        <div style="font-size: 26px; font-weight: bold; color: #1a1a2e;">{{ $stats['total_products'] }}</div>
    </div>
    <div class="card" style="border-left: 4px solid #17a2b8;">
        <div style="color: #888; font-size: 13px; margin-bottom: 5px;">Clients</div>
        <div style="font-size: 26px; font-weight: bold; color: #1a1a2e;">{{ $stats['total_users'] }}</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    <div class="card">
        <h3 style="color: #1a1a2e; margin-bottom: 20px;">🕐 Dernières commandes</h3>
        @forelse ($recentOrders as $order)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #eee;">
                <div>
                    <div style="font-weight: 600;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} - {{ $order->customer_name }}</div>
                    <div style="font-size: 12px; color: #888;">{{ $order->created_at->format('d/m/Y H:i') }} · {{ $order->items->count() }} article(s)</div>
                </div>
                <div style="text-align: right;">
                    <div style="color: #e94560; font-weight: bold;">{{ number_format($order->total, 0, ',', ' ') }} FCFA</div>
                    <div style="font-size: 11px; color: #856404;">{{ $order->status }}</div>
                </div>
            </div>
        @empty
            <p style="color: #888;">Aucune commande pour le moment.</p>
        @endforelse
    </div>

    <div class="card">
        <h3 style="color: #1a1a2e; margin-bottom: 20px;">⚠️ Stock faible</h3>
        @forelse ($lowStockProducts as $product)
            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px;">
                <span>{{ $product->name }}</span>
                <span style="color: #dc3545; font-weight: bold;">{{ $product->stock }}</span>
            </div>
        @empty
            <p style="color: #888; font-size: 13px;">Tous les stocks sont OK ✅</p>
        @endforelse
    </div>
</div>
@endsection
