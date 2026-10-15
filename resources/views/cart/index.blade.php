<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f5f0; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white; padding: 25px; border-radius: 12px;
            margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;
        }
        header h1 { font-size: 26px; }
        .back-btn {
            background: rgba(255,255,255,0.15); color: white; padding: 10px 18px;
            border-radius: 30px; text-decoration: none; font-size: 14px;
        }
        .back-btn:hover { background: rgba(255,255,255,0.25); }

        .cart-item {
            background: white; border-radius: 12px; padding: 15px;
            margin-bottom: 15px; display: flex; align-items: center; gap: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .cart-item img {
            width: 80px; height: 80px; object-fit: cover; border-radius: 8px;
        }
        .cart-item-info { flex: 1; }
        .cart-item-info h3 { font-size: 16px; color: #1a1a2e; margin-bottom: 5px; }
        .cart-item-info .price { color: #e94560; font-weight: bold; font-size: 15px; }
        .cart-item-info .qty { color: #888; font-size: 13px; margin-top: 3px; }
        .remove-btn {
            background: #ff4d4d; color: white; padding: 8px 15px;
            border-radius: 8px; text-decoration: none; font-size: 13px;
        }
        .remove-btn:hover { background: #cc0000; }

        .total-box {
            background: white; border-radius: 12px; padding: 25px;
            text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-top: 20px;
        }
        .total-box h2 { color: #1a1a2e; margin-bottom: 15px; font-size: 22px; }
        .total-box .amount { color: #e94560; font-size: 32px; font-weight: bold; margin-bottom: 20px; }
        .btn {
            display: inline-block; padding: 12px 30px; border-radius: 30px;
            text-decoration: none; font-weight: 600; margin: 5px;
        }
        .btn-primary { background: #e94560; color: white; }
        .btn-primary:hover { background: #c73650; }
        .btn-secondary { background: #ddd; color: #333; }
        .btn-secondary:hover { background: #bbb; }

        .empty { text-align: center; padding: 60px 20px; color: #888; }
        .empty h2 { margin-bottom: 15px; font-size: 22px; }

        .alert {
            background: #d4edda; color: #155724;
            padding: 12px 20px; border-radius: 8px;
            margin-bottom: 20px; text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 Mon Panier</h1>
            <a href="/" class="back-btn">← Retour au menu</a>
        </header>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @if (count($cart) > 0)
            @foreach ($cart as $id => $item)
                @php
                    $imageSrc = ($item['image'] && str_starts_with($item['image'], 'http'))
                        ? $item['image']
                        : asset('storage/' . $item['image']);
                @endphp
                <div class="cart-item">
                    <img src="{{ $imageSrc }}" alt="{{ $item['name'] }}">
                    <div class="cart-item-info">
                        <h3>{{ $item['name'] }}</h3>
                        <div class="price">{{ number_format($item['price'], 0, ',', ' ') }} FCFA</div>
                        <div class="qty">Quantité : {{ $item['quantity'] }}</div>
                    </div>
                    <a href="{{ route('cart.remove', $id) }}" class="remove-btn">🗑️ Retirer</a>
                </div>
            @endforeach

            <div class="total-box">
                <h2>Total à payer</h2>
                <div class="amount">{{ number_format($total, 0, ',', ' ') }} FCFA</div>
                <a href="{{ route('orders.checkout') }}" class="btn btn-primary">✅ Valider la commande</a>
                <a href="{{ route('cart.clear') }}" class="btn btn-secondary">Vider le panier</a>
            </div>
        @else
            <div class="empty">
                <h2>🛒 Votre panier est vide</h2>
                <p>Ajoutez des produits depuis notre menu.</p>
                <br>
                <a href="/" class="btn btn-primary">Voir le menu</a>
            </div>
        @endif
    </div>
</body>
</html>
