<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - MAGLOIRE</title>
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
            padding: 25px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        header h1 {
            font-size: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        header h1 .material-symbols-outlined {
            color: #d35400;
            font-size: 32px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .product-detail {
            display: flex;
            gap: 40px;
            padding: 40px;
            flex-wrap: wrap;
        }

        .product-detail img {
            width: 400px;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .product-info {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-info h2 {
            font-size: 36px;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .product-info .price {
            font-size: 32px;
            color: #d35400;
            font-weight: 800;
            margin: 15px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-info .old-price {
            color: #999;
            text-decoration: line-through;
            font-size: 20px;
            font-weight: 400;
        }

        .product-info .description {
            color: #666;
            line-height: 1.7;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .product-info .stock {
            color: #555;
            margin-bottom: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .product-info .stock .material-symbols-outlined {
            color: #28a745;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 15px 30px;
            background: #d35400;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn:hover {
            background:
                #b93f00;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 10px 20px;
            background: #2c3e50;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .btn-back:hover {
            background:
                #1a252f;
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 20px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <header>
        <h1><span class="material-symbols-outlined">restaurant</span> MAGLOIRE</h1>
    </header>

    <div class="container">
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div style="padding: 20px 40px 0 40px;">
            <a href="/" class="btn-back"><span class="material-symbols-outlined">arrow_back</span> Retour au
                menu</a>
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
                <div class="stock">
                    <span class="material-symbols-outlined">inventory</span> Stock disponible : {{ $product->stock }}
                </div>
                <a href="{{ route('cart.add', $product->id) }}" class="btn">
                    <span class="material-symbols-outlined">add_shopping_cart</span> Ajouter au panier
                </a>
            </div>
        </div>
    </div>
</body>

</html>
