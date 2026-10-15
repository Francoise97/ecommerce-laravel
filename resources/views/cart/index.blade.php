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

        .alert {
            padding: 12px 20px; border-radius: 8px;
            margin-bottom: 20px; text-align: center; font-weight: 500;
        }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }

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

        /* === SECTION COUPON === */
        .coupon-section {
            background: white; border-radius: 12px; padding: 20px;
            margin-bottom: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .coupon-section h3 {
            font-size: 16px; color: #1a1a2e; margin-bottom: 12px;
            display: flex; align-items: center; gap: 8px;
        }
        .coupon-form {
            display: flex; gap: 10px;
        }
        .coupon-form input {
            flex: 1; padding: 12px 18px; border: 2px solid #eee;
            border-radius: 8px; font-size: 14px; outline: none;
            text-transform: uppercase; font-weight: 600; letter-spacing: 1px;
            transition: border-color 0.2s;
        }
        .coupon-form input:focus { border-color: #e94560; }
        .coupon-form button {
            padding: 12px 25px; background: #1a1a2e; color: white;
            border: none; border-radius: 8px; font-weight: 600;
            cursor: pointer; transition: background 0.2s;
        }
        .coupon-form button:hover { background: #16213e; }

        .coupon-applied {
            display: flex; justify-content: space-between; align-items: center;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            padding: 15px 20px; border-radius: 8px;
            border-left: 4px solid #28a745;
        }
        .coupon-applied .coupon-info {
            display: flex; align-items: center; gap: 10px;
        }
        .coupon-applied .code {
            font-weight: 800; color: #155724; font-size: 16px;
            letter-spacing: 1px;
        }
        .coupon-applied .discount {
            color: #28a745; font-weight: bold; font-size: 15px;
        }
        .coupon-applied .remove-coupon {
            background: #dc3545; color: white; padding: 8px 15px;
            border-radius: 8px; text-decoration: none; font-size: 13px;
            font-weight: 600;
        }
        .coupon-applied .remove-coupon:hover { background: #b02a37; }

        /* === TOTAUX === */
        .total-box {
            background: white; border-radius: 12px; padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-top: 20px;
        }
        .total-box h2 { color: #1a1a2e; margin-bottom: 20px; font-size: 22px; text-align: center; }

        .total-line {
            display: flex; justify-content: space-between;
            padding: 10px 0; font-size: 16px;
            border-bottom: 1px solid #f0f0f0;
        }
        .total-line.discount-line { color: #28a745; font-weight: 600; }
        .total-line.final {
            border-bottom: none; border-top: 2px solid #1a1a2e;
            margin-top: 10px; padding-top: 15px;
            font-size: 22px; font-weight: 800; color: #e94560;
        }

        .btn {
            display: inline-block; padding: 14px 30px; border-radius: 30px;
            text-decoration: none; font-weight: 600; margin-top: 20px;
            text-align: center;
        }
        .btn-primary { background: #e94560; color: white; }
        .btn-primary:hover { background: #c73650; }
        .btn-secondary { background: #ddd; color: #333; margin-left: 10px; }
        .btn-secondary:hover { background: #bbb; }

        .actions-buttons { text-align: center; }

        .empty { text-align: center; padding: 60px 20px; color: #888; }
        .empty h2 { margin-bottom: 15px; font-size: 22px; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 Mon Panier</h1>
            <a href="/" class="back-btn">← Retour au menu</a>
        </header>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
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

            {{-- Section Coupon --}}
            <div class="coupon-section">
                <h3>🎟️ Code promo</h3>
                @if ($coupon)
                    <div class="coupon-applied">
                        <div class="coupon-info">
                            <span class="code">{{ $coupon['code'] }}</span>
                            <span class="discount">({{ $coupon['formatted_value'] }})</span>
                        </div>
                        <a href="{{ route('coupon.remove') }}" class="remove-coupon">✕ Retirer</a>
                    </div>
                @else
                    <form action="{{ route('coupon.apply') }}" method="POST" class="coupon-form">
                        @csrf
                        <input type="text" name="code" placeholder="Entrez votre code promo" required>
                        <button type="submit">Appliquer</button>
                    </form>
                @endif
            </div>

            {{-- Totaux --}}
            <div class="total-box">
                <h2>Récapitulatif</h2>

                <div class="total-line">
                    <span>Sous-total</span>
                    <span>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</span>
                </div>

                @if ($discount > 0)
                    <div class="total-line discount-line">
                        <span>🎟️ Réduction ({{ $coupon['code'] }})</span>
                        <span>-{{ number_format($discount, 0, ',', ' ') }} FCFA</span>
                    </div>
                @endif

                <div class="total-line final">
                    <span>TOTAL</span>
                    <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                </div>

                <div class="actions-buttons">
                    <a href="{{ route('orders.checkout') }}" class="btn btn-primary">✅ Valider la commande</a>
                    <a href="{{ route('cart.clear') }}" class="btn btn-secondary">Vider le panier</a>
                </div>
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
