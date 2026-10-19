@extends('admin.layout')

@section('title', 'Commande #' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('content')
    <a href="{{ route('admin.orders') }}" class="btn btn-secondary" style="margin-bottom: 20px;"><span
            class="material-symbols-outlined">arrow_back</span> Retour</a>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        <div class="card">
            <h3 style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px;"><span
                    class="material-symbols-outlined" style="color: #d35400;">fastfood</span> Articles commandés</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa;">
                        <th style="padding: 12px; text-align: left;">Produit</th>
                        <th style="padding: 12px; text-align: center;">Prix</th>
                        <th style="padding: 12px; text-align: center;">Qté</th>
                        <th style="padding: 12px; text-align: right;">Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px;">{{ $item->product_name }}</td>
                            <td style="padding: 12px; text-align: center;">{{ number_format($item->price, 0, ',', ' ') }}
                                FCFA</td>
                            <td style="padding: 12px; text-align: center;">{{ $item->quantity }}</td>
                            <td style="padding: 12px; text-align: right; font-weight: bold;">
                                {{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @if ($order->discount > 0)
                        <tr style="border-top: 1px solid #eee;">
                            <td colspan="3"
                                style="padding: 12px; text-align: right; color: #28a745; font-weight: 600; display: flex; align-items: center; justify-content: flex-end; gap: 5px;">
                                <span class="material-symbols-outlined" style="font-size: 18px;">local_offer</span>
                                Réduction ({{ $order->coupon_code }})
                            </td>
                            <td style="padding: 12px; text-align: right; color: #28a745; font-weight: 600;">
                                -{{ number_format($order->discount, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endif
                    <tr style="border-top: 2px solid #2c3e50

;">
                        <td colspan="3" style="padding: 15px; text-align: right; font-weight: bold; font-size: 18px;">
                            TOTAL</td>
                        <td style="padding: 15px; text-align: right; font-weight: bold; font-size: 18px; color: #d35400;">
                            {{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div>
            <div class="card">
                <h3 style="margin-bottom: 15px; display: flex; align-items: center; gap: 8px;"><span
                        class="material-symbols-outlined" style="color: #d35400;">person</span> Client</h3>
                <p style="padding: 8px 0; display: flex; align-items: center; gap: 8px;"><span
                        class="material-symbols-outlined" style="color: #888;">badge</span> <strong>Nom :</strong>
                    {{ $order->customer_name }}</p>
                <p style="padding: 8px 0; display: flex; align-items: center; gap: 8px;"><span
                        class="material-symbols-outlined" style="color: #888;">call</span> <strong>Téléphone :</strong>
                    {{ $order->customer_phone }}</p>
                @if ($order->customer_email)
                    <p style="padding: 8px 0; display: flex; align-items: center; gap: 8px;"><span
                            class="material-symbols-outlined" style="color: #888;">mail</span> <strong>Email :</strong>
                        {{ $order->customer_email }}</p>
                @endif
                <p style="padding: 8px 0; display: flex; align-items: center; gap: 8px;"><span
                        class="material-symbols-outlined" style="color: #888;">location_on</span> <strong>Adresse :</strong>
                    {{ $order->customer_address }}</p>
            </div>

            <div class="card">
                <h3 style="margin-bottom: 15px; display: flex; align-items: center; gap: 8px;"><span
                        class="material-symbols-outlined" style="color: #d35400;">edit_note</span> Statut</h3>
                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                    @csrf
                    <select name="status"
                        style="width: 100%; padding: 10px; border: 2px solid #eee; border-radius: 8px; margin-bottom: 10px; font-family: inherit;">
                        <option value="En attente" {{ $order->status == 'En attente' ? 'selected' : '' }}>En attente
                        </option>
                        <option value="En préparation" {{ $order->status == 'En préparation' ? 'selected' : '' }}>En
                            préparation</option>
                        <option value="En livraison" {{ $order->status == 'En livraison' ? 'selected' : '' }}>En livraison
                        </option>
                        <option value="Livrée" {{ $order->status == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                        <option value="Annulée" {{ $order->status == 'Annulée' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    <button type="submit" class="btn btn-primary" style="width: 100%;"><span
                            class="material-symbols-outlined">sync</span> Mettre à jour</button>
                </form>
            </div>

            <div class="card">
                <h3 style="margin-bottom: 15px; display: flex; align-items: center; gap: 8px;"><span
                        class="material-symbols-outlined" style="color: #d35400;">description</span> Facture</h3>
                <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-primary"
                    style="width: 100%; text-align: center; display: flex; justify-content: center;"><span
                        class="material-symbols-outlined">download</span> Télécharger la facture PDF</a>
            </div>
        </div>
    </div>
@endsection
