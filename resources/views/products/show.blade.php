<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - Mon E-commerce</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; padding: 20px; }
        header { background: #1a1a2e; color: white; padding: 20px; text-align: center; margin-bottom: 30px; border-radius: 8px; }
        header h1 { font-size: 28px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; }
        .product-detail { display: flex; gap: 30px; padding: 30px; flex-wrap: wrap; }
        .product-detail img { width: 400px; height: 400px; object-fit: cover; border-radius: 8px; }
        .product-info { flex: 1; min-width: 300px; }
        .product-info h2 { font-size: 32px; color: #1a1a2e; margin-bottom: 15px; }
        .product-info .price { font-size: 28px; color: #e94560; font-weight: bold; margin: 15px 0; }
        .product-info .old-price { color: #999; text-decoration: line-through; font-size: 18px; margin-left: 10px; }
        .product-info .description { color: #555; line-height: 1.6; margin-bottom: 20px; }
        .product-info .stock { color: #888; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 12px 30px; background: #e94560; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; text-decoration: none; }
        .btn:hover { background: #c73650; }
        .btn-back { display: inline-block; padding: 10px 20px; background: #555; color: white; border-radius: 4px; text-decoration: none; margin-bottom: 20px; }
        .btn-back:hover { background: #333; }
        .alert { background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin: 20px; text-align: center; }
    </style>
</head>
<body>
    <header>
        <h1>🛒 Mon E-commerce</h1>
    </header>

    <div class="container">
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div style="padding: 20px;">
            <a href="/" class="btn-back">← Retour au catalogue</a>
        </div>
        <div class="product-detail">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
            <div class="product-info">
                <h2>{{ $product->name }}</h2>
                <div class="price">
                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                    @if ($product->is_on_promo)
                        <span class="old-price">{{ number_format($product->old_price, 0, ',', ' ') }} FCFA</span>
                    @endif
                </div>
                <p class="description">{{ $product->description }}</p>
                <div class="stock">Stock disponible : <strong>{{ $product->stock }}</strong></div>
                <a href="{{ route('cart.add', $product->id) }}" class="btn">🛒 Ajouter au panier</a>
            </div>
        </div>
    </div>
</body>
</html>
