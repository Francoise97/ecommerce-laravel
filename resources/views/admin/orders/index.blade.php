@extends('admin.layout')

@section('title', 'Gestion des commandes')

@section('content')
    {{-- Filtres par statut --}}
    <div style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
        <a href="{{ route('admin.orders') }}"
            style="padding: 10px 20px; border-radius: 30px; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 5px; {{ !$status
                ? 'background: #2c3e50
            
            ; color: white;'
                : 'background: white; color: #2c3e50
            
            ; box-shadow: 0 2px 8px rgba(0,0,0,0.06);' }}">
            <span class="material-symbols-outlined" style="font-size: 18px;">list_alt</span> Toutes ({{ $counts['all'] }})
        </a>
        <a href="{{ route('admin.orders', ['status' => 'En attente']) }}"
            style="padding: 10px 20px; border-radius: 30px; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 5px; {{ $status === 'En attente' ? 'background: #ffc107; color: #333;' : 'background: white; color: #856404; box-shadow: 0 2px 8px rgba(0,0,0,0.06);' }}">
            <span class="material-symbols-outlined" style="font-size: 18px;">hourglass_top</span> En attente
            ({{ $counts['En attente'] }})
        </a>
        <a href="{{ route('admin.orders', ['status' => 'En préparation']) }}"
            style="padding: 10px 20px; border-radius: 30px; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 5px; {{ $status === 'En préparation' ? 'background: #17a2b8; color: white;' : 'background: white; color: #004085; box-shadow: 0 2px 8px rgba(0,0,0,0.06);' }}">
            <span class="material-symbols-outlined" style="font-size: 18px;">soup_kitchen</span> En préparation
            ({{ $counts['En préparation'] }})
        </a>
        <a href="{{ route('admin.orders', ['status' => 'En livraison']) }}"
            style="padding: 10px 20px; border-radius: 30px; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 5px; {{ $status === 'En livraison' ? 'background: #007bff; color: white;' : 'background: white; color: #004085; box-shadow: 0 2px 8px rgba(0,0,0,0.06);' }}">
            <span class="material-symbols-outlined" style="font-size: 18px;">local_shipping</span> En livraison
            ({{ $counts['En livraison'] }})
        </a>
        <a href="{{ route('admin.orders', ['status' => 'Livrée']) }}"
            style="padding: 10px 20px; border-radius: 30px; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 5px; {{ $status === 'Livrée' ? 'background: #28a745; color: white;' : 'background: white; color: #155724; box-shadow: 0 2px 8px rgba(0,0,0,0.06);' }}">
            <span class="material-symbols-outlined" style="font-size: 18px;">check_circle</span> Livrée
            ({{ $counts['Livrée'] }})
        </a>
        <a href="{{ route('admin.orders', ['status' => 'Annulée']) }}"
            style="padding: 10px 20px; border-radius: 30px; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 5px; {{ $status === 'Annulée' ? 'background: #dc3545; color: white;' : 'background: white; color: #721c24; box-shadow: 0 2px 8px rgba(0,0,0,0.06);' }}">
            <span class="material-symbols-outlined" style="font-size: 18px;">cancel</span> Annulée
            ({{ $counts['Annulée'] }})
        </a>
    </div>

    <div class="card" style="padding: 0; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 15px;">N°</th>
                    <th style="padding: 15px;">Client</th>
                    <th style="padding: 15px;">Téléphone</th>
                    <th style="padding: 15px;">Articles</th>
                    <th style="padding: 15px;">Total</th>
                    <th style="padding: 15px;">Statut</th>
                    <th style="padding: 15px;">Date</th>
                    <th style="padding: 15px; text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px; font-weight: 600;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding: 12px;">{{ $order->customer_name }}</td>
                        <td style="padding: 12px;">{{ $order->customer_phone }}</td>
                        <td style="padding: 12px;">{{ $order->items->count() }}</td>
                        <td style="padding: 12px; color: #d35400; font-weight: bold;">
                            {{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                        <td style="padding: 12px;">
                            @if ($order->status == 'En attente')
                                <span
                                    style="background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 12px; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;"><span
                                        class="material-symbols-outlined" style="font-size: 14px;">hourglass_top</span>
                                    {{ $order->status }}</span>
                            @elseif ($order->status == 'Livrée')
                                <span
                                    style="background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 12px; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;"><span
                                        class="material-symbols-outlined" style="font-size: 14px;">check_circle</span>
                                    {{ $order->status }}</span>
                            @elseif ($order->status == 'Annulée')
                                <span
                                    style="background: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 12px; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;"><span
                                        class="material-symbols-outlined" style="font-size: 14px;">cancel</span>
                                    {{ $order->status }}</span>
                            @else
                                <span
                                    style="background: #cce5ff; color: #004085; padding: 4px 10px; border-radius: 12px; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;"><span
                                        class="material-symbols-outlined" style="font-size: 14px;">local_shipping</span>
                                    {{ $order->status }}</span>
                            @endif
                        </td>
                        <td style="padding: 12px; font-size: 12px; color: #888;">
                            {{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm"><span
                                    class="material-symbols-outlined" style="font-size: 16px;">visibility</span> Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding: 40px; text-align: center; color: #888;">
                            <span class="material-symbols-outlined"
                                style="font-size: 40px; color: #ccc; margin-bottom: 10px;">inbox</span><br>
                            Aucune commande{{ $status ? ' avec le statut "' . $status . '"' : '' }}.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
