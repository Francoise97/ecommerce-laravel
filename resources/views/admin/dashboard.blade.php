@extends('admin.layout')

@section('title', 'Tableau de bord')

@section('content')
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        {{-- Carte CA --}}
        <div class="card" style="border-left: 4px solid #d35400; display: flex; align-items: center; gap: 15px;">
            <span class="material-symbols-outlined"
                style="font-size: 40px; color: #d35400; background: #ffe6ea; padding: 10px; border-radius: 12px;">payments</span>
            <div>
                <div style="color: #888; font-size: 13px; margin-bottom: 5px;">CA total</div>
                <div style="font-size: 24px; font-weight: bold; color: #2c3e50

;">
                    {{ number_format($stats['total_revenue'], 0, ',', ' ') }} FCFA</div>
            </div>
        </div>
        <div style="background: #fff3cd; color: #856404; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
    <span class="material-symbols-outlined">waving_hand</span>
    <div>
        <strong>Bienvenue sur votre tableau de bord !</strong><br>
        <span style="font-size: 13px;">Voici le résumé de l'activité de votre restaurant aujourd'hui.</span>
    </div>
    </div>

        {{-- Carte Commandes --}}
        <div class="card" style="border-left: 4px solid #28a745; display: flex; align-items: center; gap: 15px;">
            <span class="material-symbols-outlined"
                style="font-size: 40px; color: #28a745; background: #e8f5e9; padding: 10px; border-radius: 12px;">inventory_2</span>
            <div>
                <div style="color: #888; font-size: 13px; margin-bottom: 5px;">Commandes</div>
                <div style="font-size: 24px; font-weight: bold; color: #2c3e50

;">{{ $stats['total_orders'] }}</div>
                <div
                    style="color: #d35400; font-size: 12px; margin-top: 5px; display: flex; align-items: center; gap: 3px;">
                    <span class="material-symbols-outlined" style="font-size: 14px;">hourglass_top</span>
                    {{ $stats['pending_orders'] }} en attente
                </div>
            </div>
        </div>

        {{-- Carte Produits --}}
        <div class="card" style="border-left: 4px solid #ffc107; display: flex; align-items: center; gap: 15px;">
            <span class="material-symbols-outlined"
                style="font-size: 40px; color: #ffc107; background: #fff8e1; padding: 10px; border-radius: 12px;">restaurant_menu</span>
            <div>
                <div style="color: #888; font-size: 13px; margin-bottom: 5px;">Produits</div>
                <div style="font-size: 24px; font-weight: bold; color: #2c3e50

;">{{ $stats['total_products'] }}</div>
            </div>
        </div>

        {{-- Carte Clients --}}
        <div class="card" style="border-left: 4px solid #17a2b8; display: flex; align-items: center; gap: 15px;">
            <span class="material-symbols-outlined"
                style="font-size: 40px; color: #17a2b8; background: #e0f7fa; padding: 10px; border-radius: 12px;">group</span>
            <div>
                <div style="color: #888; font-size: 13px; margin-bottom: 5px;">Clients</div>
                <div style="font-size: 24px; font-weight: bold; color: #2c3e50

;">{{ $stats['total_users'] }}</div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        {{-- Dernières commandes --}}
        <div class="card">
            <h3 style="color: #2c3e50

; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: #d35400;">schedule</span> Dernières commandes
            </h3>
            @forelse ($recentOrders as $order)
                <div
                    style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #eee;">
                    <div>
                        <div style="font-weight: 600; display: flex; align-items: center; gap: 5px;">
                            #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} - {{ $order->customer_name }}
                        </div>
                        <div style="font-size: 12px; color: #888; margin-top: 3px;">
                            {{ $order->created_at->format('d/m/Y H:i') }} · {{ $order->items->count() }} article(s)
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="color: #d35400; font-weight: bold;">{{ number_format($order->total, 0, ',', ' ') }} FCFA
                        </div>
                        <div style="font-size: 11px; color: #856404;">{{ $order->status }}</div>
                    </div>
                </div>
            @empty
                <p style="color: #888;">Aucune commande pour le moment.</p>
            @endforelse
        </div>

        {{-- Stock faible --}}
        <div class="card">
            <h3 style="color: #2c3e50

; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: #ffc107;">warning</span> Stock faible
            </h3>
            @forelse ($lowStockProducts as $product)
                <div
                    style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px;">
                    <span>{{ $product->name }}</span>
                    <span style="color: #dc3545; font-weight: bold;">{{ $product->stock }}</span>
                </div>
            @empty
                <p style="color: #888; font-size: 13px; display: flex; align-items: center; gap: 5px;">
                    <span class="material-symbols-outlined" style="color: #28a745;">check_circle</span> Tous les stocks sont
                    OK
                </p>
            @endforelse
        </div>
    </div>
@endsection
