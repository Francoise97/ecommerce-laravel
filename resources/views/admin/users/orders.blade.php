@extends('admin.layout')

@section('title', 'Commandes de ' . $user->name)

@section('content')
<a href="{{ route('admin.users') }}" class="btn btn-secondary" style="margin-bottom: 20px;">
    <span class="material-symbols-outlined">arrow_back</span> Retour aux clients
</a>

<div class="card">
    <h3 style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
        <span class="material-symbols-outlined" style="color: #d35400;">receipt_long</span>
        Historique des commandes
    </h3>

    @if($orders->count() > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px;">N°</th>
                    <th style="padding: 12px;">Date</th>
                    <th style="padding: 12px;">Articles</th>
                    <th style="padding: 12px;">Total</th>
                    <th style="padding: 12px;">Statut</th>
                    <th style="padding: 12px; text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px; font-weight: 600;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding: 12px; font-size: 13px;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td style="padding: 12px;">{{ $order->items->count() }}</td>
                        <td style="padding: 12px; color: #d35400; font-weight: bold;">{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                        <td style="padding: 12px;">
                            @if ($order->status == 'En attente')
                                <span style="background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 12px; font-size: 12px;">{{ $order->status }}</span>
                            @elseif ($order->status == 'Livrée')
                                <span style="background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 12px; font-size: 12px;">{{ $order->status }}</span>
                            @else
                                <span style="background: #cce5ff; color: #004085; padding: 4px 10px; border-radius: 12px; font-size: 12px;">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm">
                                <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span> Détails
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px; color: #888;">
            <span class="material-symbols-outlined" style="font-size: 40px; color: #ccc; margin-bottom: 10px;">inbox</span><br>
            Ce client n'a pas encore passé de commande.
        </div>
    @endif
</div>
@endsection
