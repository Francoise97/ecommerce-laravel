<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Panier - MAGLOIRE</title>
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

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        header {
            background: linear-gradient(135deg, #2c3e50 0%,
                    #1a252f 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
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

        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        .cart-item {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-info h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .cart-item-info .price {
            color: #d35400;
            font-weight: bold;
            font-size: 15px;
        }

        .cart-item-info .qty {
            color: #888;
            font-size: 13px;
            margin-top: 3px;
        }

        .remove-btn {
            background: #ff4d4d;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .remove-btn:hover {
            background: #cc0000;
        }

        .coupon-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .coupon-section h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .coupon-section h3 .material-symbols-outlined {
            color: #d35400;
        }

        .coupon-form {
            display: flex;
            gap: 10px;
        }

        .coupon-form input {
            flex: 1;
            padding: 12px 18px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            text-transform: uppercase;
            font-weight: 600;
        }

        .coupon-form input:focus {
            border-color: #d35400;
        }

        .coupon-form button {
            padding: 12px 25px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .coupon-form button:hover {
            background:
                #1a252f;
        }

        .coupon-applied {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            padding: 15px 20px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }

        .coupon-applied .code {
            font-weight: 800;
            color: #155724;
            font-size: 16px;
            letter-spacing: 1px;
        }

        .coupon-applied .discount {
            color: #28a745;
            font-weight: bold;
            font-size: 15px;
        }

        .coupon-applied .remove-coupon {
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .total-box {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
        }

        .total-box h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 22px;
            text-align: center;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 16px;
            border-bottom: 1px solid #f0f0f0;
        }

        .total-line.discount-line {
            color: #28a745;
            font-weight: 600;
        }

        .total-line.final {
            border-bottom: none;
            border-top: 2px solid #2c3e50;
            margin-top: 10px;
            padding-top: 15px;
            font-size: 22px;
            font-weight: 800;
            color: #d35400;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 14px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            text-align: center;
        }

        .btn-primary {
            background: #d35400;
            color: white;
        }

        .btn-primary:hover {
            background:
                #b93f00;
        }

        .btn-secondary {
            background: #ddd;
            color: #333;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background: #bbb;
        }

        .actions-buttons {
            text-align: center;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }

        .empty h2 {
            margin-bottom: 15px;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .empty h2 .material-symbols-outlined {
            font-size: 32px;
            color: #d35400;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1><span class="material-symbols-outlined">shopping_cart</span> Mon Panier</h1>
            <a href="/" class="back-btn"><span class="material-symbols-outlined"
                    style="font-size: 18px;">arrow_back</span> Retour au menu</a>
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
                    $imageSrc =
                        $item['image'] && str_starts_with($item['image'], 'http')
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
                    <a href="{{ route('cart.remove', $id) }}" class="remove-btn"><span class="material-symbols-outlined"
                            style="font-size: 18px;">delete</span> Retirer</a>
                </div>
            @endforeach

            <div class="coupon-section">
                <h3><span class="material-symbols-outlined">confirmation_number</span> Code promo</h3>
                @if ($coupon)
                    <div class="coupon-applied">
                        <div class="coupon-info">
                            <span class="code">{{ $coupon['code'] }}</span>
                            <span class="discount">({{ $coupon['formatted_value'] }})</span>
                        </div>
                        <a href="{{ route('coupon.remove') }}" class="remove-coupon"><span
                                class="material-symbols-outlined" style="font-size: 16px;">close</span> Retirer</a>
                    </div>
                @else
                    <form action="{{ route('coupon.apply') }}" method="POST" class="coupon-form">
                        @csrf
                        <input type="text" name="code" placeholder="Entrez votre code promo" required>
                        <button type="submit"><span class="material-symbols-outlined">local_offer</span>
                            Appliquer</button>
                    </form>
                @endif
            </div>

            <div class="total-box">
                <h2>Récapitulatif</h2>
                <div class="total-line">
                    <span>Sous-total</span>
                    <span>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</span>
                </div>
                @if ($discount > 0)
                    <div class="total-line discount-line">
                        <span><span class="material-symbols-outlined" style="font-size: 18px;">local_offer</span>
                            Réduction ({{ $coupon['code'] }})</span>
                        <span>-{{ number_format($discount, 0, ',', ' ') }} FCFA</span>
                    </div>
                @endif
                <div class="total-line final">
                    <span>TOTAL</span>
                    <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                </div>

                <div class="actions-buttons">
                    <a href="{{ route('orders.checkout') }}" class="btn btn-primary"><span
                            class="material-symbols-outlined">check_circle</span> Valider la commande</a>
                    <a href="{{ route('cart.clear') }}" class="btn btn-secondary"><span
                            class="material-symbols-outlined">delete_sweep</span> Vider le panier</a>
                </div>
            </div>
        @else
            <div class="empty">
                <h2><span class="material-symbols-outlined">remove_shopping_cart</span> Votre panier est vide</h2>
                <p>Ajoutez des produits depuis notre menu.</p>
                <br>
                <a href="/" class="btn btn-primary"><span class="material-symbols-outlined">restaurant</span> Voir
                    le menu</a>
            </div>
        @endif
    </div>
</body>

</html>
