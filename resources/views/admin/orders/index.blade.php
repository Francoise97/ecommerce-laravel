@extends('admin.layout')

@section('title', 'Gestion des commandes')

@section('content')
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
                    <td style="padding: 12px; color: #e94560; font-weight: bold;">{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                    <td style="padding: 12px;">
                        @if ($order->status == 'En attente')
                            <span style="background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 12px; font-size: 12px;">⏳ {{ $order->status }}</span>
                        @elseif ($order->status == 'Livrée')
                            <span style="background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 12px; font-size: 12px;">✅ {{ $order->status }}</span>
                        @else
                            <span style="background: #cce5ff; color: #004085; padding: 4px 10px; border-radius: 12px; font-size: 12px;">{{ $order->status }}</span>
                        @endif
                    </td>
                    <td style="padding: 12px; font-size: 12px; color: #888;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding: 12px; text-align: right;">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm">👁️ Voir</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" style="padding: 30px; text-align: center; color: #888;">Aucune commande.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
