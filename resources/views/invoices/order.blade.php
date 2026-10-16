<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Facture #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            padding: 30px;
            background: white;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #1a1a2e;
        }

        .header h1 {
            font-size: 28px;
            color: #1a1a2e;
        }

        .header .restaurant-info {
            text-align: right;
            font-size: 11px;
            color: #666;
            line-height: 1.5;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-info .col {
            width: 48%;
        }

        .invoice-info h3 {
            font-size: 13px;
            color: #1a1a2e;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        .invoice-info p {
            font-size: 11px;
            line-height: 1.6;
            color: #555;
        }

        .invoice-info strong {
            color: #1a1a2e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background: #1a1a2e;
            color: white;
        }

        th {
            padding: 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        th:nth-child(2),
        th:nth-child(3),
        th:nth-child(4) {
            text-align: center;
        }

        th:last-child {
            text-align: right;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 11px;
        }

        td:nth-child(2),
        td:nth-child(3) {
            text-align: center;
        }

        td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .totals {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .totals-table {
            width: 300px;
        }

        .totals-table tr td {
            padding: 8px 10px;
        }

        .totals-table tr td:first-child {
            text-align: right;
            color: #666;
        }

        .totals-table tr td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .totals-table .total-row {
            border-top: 2px solid #1a1a2e;
            font-size: 14px;
        }

        .totals-table .total-row td {
            padding-top: 12px;
        }

        .totals-table .total-row td:last-child {
            color: #e94560;
            font-size: 16px;
            font-weight: 800;
        }

        .discount-row td:last-child {
            color: #28a745;
        }

        .status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-done {
            background: #d4edda;
            color: #155724;
        }

        .status-cancel {
            background: #f8d7da;
            color: #721c24;
        }

        .status-progress {
            background: #cce5ff;
            color: #004085;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 10px;
            color: #888;
        }

        .thank-you {
            text-align: center;
            margin: 25px 0;
            font-size: 14px;
            color: #1a1a2e;
            font-weight: 600;
        }
    </style>
</head>

<body>
    {{-- En-tête --}}
    <div class="header">
        <div>
            <h1>🍽️MAGLOIRE</h1>
            <p style="font-size: 11px; color: #666; margin-top: 5px;">FACTURE</p>
        </div>
        <div class="restaurant-info">
            <strong>Mon Restaurant</strong><br>
            Lomé, Togo<br>
            Tél : +228 XX XX XX XX<br>
            contact@monrestaurant.tg
        </div>
    </div>

    {{-- Informations facture + client --}}
    <div class="invoice-info">
        <div class="col">
            <h3>DÉTAILS DE LA FACTURE</h3>
            <p>
                <strong>Numéro :</strong> #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}<br>
                <strong>Date :</strong> {{ $order->created_at->format('d/m/Y à H:i') }}<br>
                <strong>Statut :</strong>
                @if ($order->status == 'En attente')
                <span class="status status-pending">{{ $order->status }}</span>
                @elseif ($order->status == 'Livrée')
                <span class="status status-done">{{ $order->status }}</span>
                @elseif ($order->status == 'Annulée')
                <span class="status status-cancel">{{ $order->status }}</span>
                @else
                <span class="status status-progress">{{ $order->status }}</span>
                @endif
            </p>
        </div>
        <div class="col">
            <h3>FACTURÉ À</h3>
            <p>
                <strong>{{ $order->customer_name }}</strong><br>
                Tél : {{ $order->customer_phone }}<br>
                @if ($order->customer_email)
                Email : {{ $order->customer_email }}<br>
                @endif
                Adresse : {{ $order->customer_address }}
            </p>
        </div>
    </div>

    {{-- Tableau des articles --}}
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ number_format($item->price, 0, ',', ' ') }} FCFA</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totaux --}}
    <div class="totals">
        <table class="totals-table">
            <tr>
                <td>Sous-total</td>
                <td>{{ number_format($order->total + $order->discount, 0, ',', ' ') }} FCFA</td>
            </tr>
            @if ($order->discount > 0)
            <tr class="discount-row">
                <td>🎟️ Réduction ({{ $order->coupon_code }})</td>
                <td>-{{ number_format($order->discount, 0, ',', ' ') }} FCFA</td>
            </tr>
            @endif
            <tr class="total-row">
                <td>TOTAL</td>
                <td>{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
            </tr>
        </table>
    </div>

    {{-- Message de remerciement --}}
    <div class="thank-you">
        Merci pour votre commande ! 🍽️
    </div>

    {{-- Pied de page --}}
    <div class="footer">
        Cette facture a été générée automatiquement le {{ now()->format('d/m/Y à H:i') }}.<br>
        MAGLOIRE — Tous droits réservés.
    </div>
</body>

</html>