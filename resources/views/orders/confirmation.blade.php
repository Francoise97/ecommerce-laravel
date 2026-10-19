<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Commande confirmée - MAGLOIRE</title>
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
            padding: 40px 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .check {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 15px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .info-box {
            background: #f8f5f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: left;
        }

        .info-box h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 5px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
        }

        .info-box h3 .material-symbols-outlined {
            color: #d35400;
        }

        .info-line {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            border-bottom: 1px solid #eee;
        }

        .info-line:last-child {
            border-bottom: none;
        }

        .info-line strong {
            color: #333;
        }

        .info-line span {
            color: #666;
            text-align: right;
        }

        .items-list {
            text-align: left;
        }

        .item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .item:last-child {
            border-bottom: none;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 2px solid #2c3e50;
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #d35400;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #fff3cd;
            color: #856404;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-badge .material-symbols-outlined {
            font-size: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 25px;
            background: #2c3e50;
            color: white;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #d35400;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <span class="material-symbols-outlined check">check_circle</span>
            <h1>Merci pour votre commande !</h1>
            <p class="subtitle"><span class="material-symbols-outlined">restaurant</span> MAGLOIRE</p>

            <div class="info-box">
                <h3><span class="material-symbols-outlined">receipt_long</span> Informations de commande</h3>
                <div class="info-line"><strong>Numéro</strong>
                    <span>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="info-line"><strong>Client</strong> <span>{{ $order->customer_name }}</span></div>
                <div class="info-line"><strong>Téléphone</strong> <span>{{ $order->customer_phone }}</span></div>
                <div class="info-line"><strong>Adresse</strong> <span>{{ $order->customer_address }}</span></div>
                <div class="info-line"><strong>Statut</strong> <span class="status-badge"><span
                            class="material-symbols-outlined">hourglass_top</span> {{ $order->status }}</span></div>
            </div>

            <div class="info-box">
                <h3><span class="material-symbols-outlined">fastfood</span> Vos articles</h3>
                <div class="items-list">
                    @foreach ($order->items as $item)
                        <div class="item">
                            <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                            <span>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</span>
                        </div>
                    @endforeach
                </div>
                @if ($order->discount > 0)
                    <div class="item"
                        style="color: #28a745; font-weight: 600; border-bottom: none; margin-top: 10px;">
                        <span><span class="material-symbols-outlined" style="font-size: 16px;">local_offer</span>
                            Réduction ({{ $order->coupon_code }})</span>
                        <span>-{{ number_format($order->discount, 0, ',', ' ') }} FCFA</span>
                    </div>
                @endif
                <div class="total-line">
                    <span>Total payé</span>
                    <span>{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>

            <a href="{{ route('orders.invoice', $order->id) }}" class="btn"
                style="background: #d35400; margin-right: 10px;"><span
                    class="material-symbols-outlined">picture_as_pdf</span> Télécharger la facture</a>
            <a href="/" class="btn"><span class="material-symbols-outlined">home</span> Retour au menu</a>
        </div>
    </div>
</body>

</html>
