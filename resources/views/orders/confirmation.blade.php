<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande confirmée</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f5f0; padding: 40px 20px; }
        .container { max-width: 700px; margin: 0 auto; }
        .card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; }
        .check { font-size: 70px; margin-bottom: 15px; }
        h1 { color: #1a1a2e; margin-bottom: 10px; font-size: 28px; }
        .subtitle { color: #666; margin-bottom: 30px; }

        .info-box {
            background: #f8f5f0; border-radius: 12px; padding: 20px;
            margin-bottom: 20px; text-align: left;
        }
        .info-box h3 { color: #1a1a2e; margin-bottom: 15px; font-size: 16px; }
        .info-line { display: flex; justify-content: space-between; padding: 8px 0; font-size: 14px; border-bottom: 1px solid #eee; }
        .info-line:last-child { border-bottom: none; }
        .info-line strong { color: #333; }
        .info-line span { color: #666; }

        .items-list { text-align: left; }
        .item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px; }
        .item:last-child { border-bottom: none; }

        .total-line {
            display: flex; justify-content: space-between; padding: 15px 0;
            border-top: 2px solid #1a1a2e; margin-top: 10px;
            font-size: 18px; font-weight: bold; color: #e94560;
        }

        .status-badge {
            display: inline-block; background: #fff3cd; color: #856404;
            padding: 6px 15px; border-radius: 20px; font-size: 13px;
            font-weight: 600; margin-top: 5px;
        }

        .btn {
            display: inline-block; margin-top: 25px;
            padding: 12px 30px; background: #e94560; color: white;
            border-radius: 30px; text-decoration: none; font-weight: 600;
        }
        .btn:hover { background: #c73650; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="check">✅</div>
            <h1>Merci pour votre commande !</h1>
            <p class="subtitle">Votre commande a bien été enregistrée.</p>

            <div class="info-box">
                <h3>📦 Informations de commande</h3>
                <div class="info-line"><strong>Numéro</strong> <span>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></div>
                <div class="info-line"><strong>Client</strong> <span>{{ $order->customer_name }}</span></div>
                <div class="info-line"><strong>Téléphone</strong> <span>{{ $order->customer_phone }}</span></div>
                <div class="info-line"><strong>Adresse</strong> <span>{{ $order->customer_address }}</span></div>
                <div class="info-line"><strong>Statut</strong> <span class="status-badge">{{ $order->status }}</span></div>
            </div>

            <div class="info-box">
                <h3>🍽️ Vos articles</h3>
                <div class="items-list">
                    @foreach ($order->items as $item)
                        <div class="item">
                            <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                            <span>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</span>
                        </div>
                    @endforeach
                </div>
                <div class="total-line">
                    <span>Total payé</span>
                    <span>{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>

            <a href="/" class="btn">Retour au menu</a>
        </div>
    </div>
</body>
</html>
