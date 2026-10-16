<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Restaurant - Menu</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f8f5f0;
            padding: 20px;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 25px 30px;
            margin-bottom: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        header h1 {
            font-size: 28px;
            font-weight: 700;
        }

        .cart-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e94560;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
        }

        .cart-btn:hover {
            background: #c73650;
        }

        .cart-count {
            background: white;
            color: #e94560;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-bar input {
            flex: 1;
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 30px;
            font-size: 14px;
            outline: none;
        }

        .search-bar input:focus {
            border-color: #e94560;
        }

        .search-bar button {
            padding: 12px 25px;
            background: #1a1a2e;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
        }

        .search-bar button:hover {
            background: #e94560;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background: white;
            color: #1a1a2e;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #e94560;
            color: white;
            transform: translateY(-2px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
        }

        .card-image-wrapper {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(26, 26, 46, 0.9);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .promo-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #e94560;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .card-body {
            padding: 18px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .card-body h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #1a1a2e;
            font-weight: 700;
        }

        .card-body p {
            font-size: 13px;
            color: #777;
            margin-bottom: 15px;
            line-height: 1.5;
            flex: 1;
        }

        .price-block {
            margin-bottom: 8px;
        }

        .price {
            color: #e94560;
            font-size: 20px;
            font-weight: 800;
        }

        .old-price {
            color: #999;
            text-decoration: line-through;
            font-size: 14px;
            margin-left: 8px;
        }

        .stock {
            font-size: 12px;
            color: #888;
            margin-bottom: 12px;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            background: #1a1a2e;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
        }

        .btn:hover {
            background: #16213e;
        }

        .btn-cart {
            background: #e94560;
        }

        .btn-cart:hover {
            background: #c73650;
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>

            <div>
    <h1 style="font-size: 28px; font-weight: 700;"> MAGLOIRE</h1>
    <p style="font-size: 12px; opacity: 0.7; margin-top: 2px; font-weight: 400;">L'excellence dans chaque bouchée</p>
</div>
                @auth
                <a href="{{ route('profile.show') }}" style="color: #fff; font-size: 14px; text-decoration: none;">👤 {{ Auth::user()->name }}</a>
                <a href="{{ route('profile.show') }}" style="background: rgba(255,255,255,0.15); color: white; padding: 8px 15px; border-radius: 30px; text-decoration: none; font-size: 13px;">👤 Mon profil</a>
                <a href="{{ route('orders.my') }}" style="background: rgba(255,255,255,0.15); color: white; padding: 8px 15px; border-radius: 30px; text-decoration: none; font-size: 13px;">📦 Mes commandes</a>
                </a>
                @if (Auth::user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" style="background: #ffc107; color: #333; padding: 8px 15px; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 13px;">
                    ⚙️ Admin
                </a>
                @endif

                {{-- Séparateur visuel --}}
                <span style="width: 1px; height: 24px; background: rgba(255,255,255,0.2);"></span>

                {{-- Déconnexion --}}
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: transparent; color: rgba(255,255,255,0.8); border: 1px solid rgba(255,255,255,0.3); padding: 8px 15px; border-radius: 30px; cursor: pointer; font-size: 13px;">
                        🚪 Déconnexion
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" style="background: rgba(255,255,255,0.15); color: white; padding: 8px 18px; border-radius: 30px; text-decoration: none; font-size: 13px;">
                    Connexion
                </a>
                <a href="{{ route('register') }}" style="background: #e94560; color: white; padding: 8px 18px; border-radius: 30px; text-decoration: none; font-size: 13px;">
                    Inscription
                </a>
                @endauth

                {{-- Panier en évidence à droite --}}
                <a href="{{ route('cart.index') }}" class="cart-btn">
                    🛒 Panier
                    <span class="cart-count">{{ count(session('cart', [])) }}</span>
                </a>
            </div>
        </header>

        @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="/" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="🔍 Rechercher un plat..." value="{{ $search ?? '' }}">
            <button type="submit">Rechercher</button>
        </form>

        <div class="filters">
            <a href="/" class="filter-btn {{ !$currentCategory ? 'active' : '' }}">🍴 Tous</a>
            <a href="/?category=Entrée" class="filter-btn {{ $currentCategory === 'Entrée' ? 'active' : '' }}">🥗 Entrées</a>
            <a href="/?category=Plat" class="filter-btn {{ $currentCategory === 'Plat' ? 'active' : '' }}">🍕 Plats</a>
            <a href="/?category=Dessert" class="filter-btn {{ $currentCategory === 'Dessert' ? 'active' : '' }}">🍰 Desserts</a>
            <a href="/?category=Boisson" class="filter-btn {{ $currentCategory === 'Boisson' ? 'active' : '' }}">🥤 Boissons</a>
        </div>

        <div class="grid">
            @forelse ($products as $product)
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    <span class="badge">{{ $product->category }}</span>
                    @if ($product->is_on_promo)
                    <span class="promo-badge">🔥 Promo</span>
                    @endif
                </div>
                <div class="card-body">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description, 70) }}</p>
                    <div class="price-block">
                        <span class="price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                        @if ($product->is_on_promo)
                        <span class="old-price">{{ number_format($product->old_price, 0, ',', ' ') }} FCFA</span>
                        @endif
                    </div>
                    <div class="stock">Stock : {{ $product->stock }}</div>
                    <div class="actions">
                        <a href="/produit/{{ $product->id }}" class="btn">Détails</a>
                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-cart">🛒 Ajouter</a>
                    </div>
                </div>
            </div>
            @empty
            <p style="grid-column: 1/-1; text-align: center; color: #888; padding: 40px;">
                Aucun produit trouvé.
            </p>
            @endforelse
        </div>
    </div>
</body>

</html>
