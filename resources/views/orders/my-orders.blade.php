<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mes commandes - MAGLOIRE</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f5f0;
            padding: 20px;
        }

        header {
            background: linear-gradient(135deg, #2c3e50 0%,
                    #1a252f 100%);
            color: white;
            padding: 25px 30px;
            margin-bottom: 25px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 26px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        header h1 .material-symbols-outlined {
            color: #d35400;
            font-size: 32px;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 10px 18px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .order-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            transition: all 0.2s;
        }

        .order-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-num {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
        }

        .order-date {
            font-size: 13px;
            color: #888;
            margin-top: 3px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge .material-symbols-outlined {
            font-size: 16px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-progress {
            background: #cce5ff;
            color: #004085;
        }

        .status-done {
            background: #d4edda;
            color: #155724;
        }

        .status-cancel {
            background: #f8d7da;
            color: #721c24;
        }

        .items-list {
            margin-bottom: 15px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            color: #555;
            border-bottom: 1px solid #f5f5f5;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 2px solid #2c3e50;
        }

        .total-label {
            font-size: 14px;
            color: #666;
        }

        .total-amount {
            font-size: 22px;
            font-weight: 700;
            color: #d35400;
        }

        .empty {
            background: white;
            border-radius: 12px;
            padding: 60px 20px;
            text-align: center;
            color: #888;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .empty .material-symbols-outlined {
            font-size: 60px;
            color: #ccc;
            margin-bottom: 15px;
        }

        .empty h2 {
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 12px 30px;
            background: #d35400;
            color: white;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background:
                #b93f00;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1><span class="material-symbols-outlined">inventory_2</span> Mes commandes</h1>
            <a href="/" class="back-btn"><span class="material-symbols-outlined"
                    style="font-size: 18px;">arrow_back</span> Retour au menu</a>
        </header>

        @forelse ($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-num">Commande #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                        <div class="order-date"><span class="material-symbols-outlined"
                                style="font-size: 16px;">calendar_today</span>
                            {{ $order->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                    <div>
                        @if ($order->status == 'En attente')
                            <span class="status-badge status-pending"><span
                                    class="material-symbols-outlined">hourglass_top</span> {{ $order->status }}</span>
                        @elseif ($order->status == 'Livrée')
                            <span class="status-badge status-done"><span
                                    class="material-symbols-outlined">check_circle</span> {{ $order->status }}</span>
                        @elseif ($order->status == 'Annulée')
                            <span class="status-badge status-cancel"><span
                                    class="material-symbols-outlined">cancel</span> {{ $order->status }}</span>
                        @else
                            <span class="status-badge status-progress"><span
                                    class="material-symbols-outlined">local_shipping</span> {{ $order->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="items-list">
                    @foreach ($order->items as $item)
                        <div class="item-row">
                            <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                            <span>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</span>
                        </div>
                    @endforeach
                </div>

                @if ($order->discount > 0)
                    <div class="item-row" style="color: #28a745; font-weight: 600;">
                        <span><span class="material-symbols-outlined" style="font-size: 16px;">local_offer</span>
                            Réduction ({{ $order->coupon_code }})</span>
                        <span>-{{ number_format($order->discount, 0, ',', ' ') }} FCFA</span>
                    </div>
                @endif

                <div class="order-footer">
                    <span class="total-label">Total payé</span>
                    <span class="total-amount">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                </div>

                <div style="text-align: right; margin-top: 15px;">
                    <a href="{{ route('orders.invoice', $order->id) }}"
                        style="display: inline-flex; align-items: center; gap: 5px; padding: 10px 20px; background: #2c3e50

; color: white; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600;">
                        <span class="material-symbols-outlined" style="font-size: 18px;">picture_as_pdf</span>
                        Télécharger la facture PDF
                    </a>
                </div>
            </div>
        @empty
            <div class="empty">
                <span class="material-symbols-outlined">inbox</span>
                <h2>Aucune commande pour le moment</h2>
                <p>Vous n'avez encore rien commandé.</p>
                <a href="/" class="btn-primary"><span class="material-symbols-outlined">restaurant</span> Voir le
                    menu</a>
            </div>
        @endforelse
    </div>
</body>

</html>
