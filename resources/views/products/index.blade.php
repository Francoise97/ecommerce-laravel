<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAGLOIRE - Menu</title>
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
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #fdfbf7;
            padding: 20px;
            min-height: 100vh;
        }

        /* --- HEADER --- */
        header {
            background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        header h1 .material-symbols-outlined {
            font-size: 32px;
            color: #d35400;
        }

        .cart-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #d35400;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s;
        }

        .cart-btn:hover {
            background: #b93f00;
        }

        .cart-count {
            background: white;
            color: #d35400;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        /* --- BARRE DE RECHERCHE --- */
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
            transition: border-color 0.2s;
        }

        .search-bar input:focus {
            border-color: #d35400;
        }

        .search-bar button {
            padding: 12px 25px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background 0.2s;
        }

        .search-bar button:hover {
            background: #d35400;
        }

        /* --- FILTRES --- */
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
            color: #2c3e50;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.2s;
        }

        .filter-btn .material-symbols-outlined {
            color: #d35400;
            transition: color 0.2s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #d35400;
            color: white;
            transform: translateY(-2px);
        }

        .filter-btn:hover .material-symbols-outlined,
        .filter-btn.active .material-symbols-outlined {
            color: white;
        }

        /* --- GRILLE ET CARTES PRODUITS --- */
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
            transition: all 0.4s ease;
            border: 2px solid transparent;
        }

        /* Effet Hover */
        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(211, 84, 0, 0.2);
            border-color: #d35400;
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
            transition: transform 0.5s ease;
        }

        .card:hover img {
            transform: scale(1.15);
        }

        /* Badges */
        .badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(44, 62, 80, 0.9);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            z-index: 2;
        }

        .promo-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #d35400;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 3px;
            z-index: 2;
        }

        .new-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: #28a745;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 3px;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.4);
            z-index: 2;
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
            color: #2c3e50;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .card:hover .card-body h3 {
            color: #d35400;
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
            color: #d35400;
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

        /* Boutons */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.2s;
        }

        .btn:hover {
            background: #1a252f;
        }

        .btn-cart {
            background: #d35400;
        }

        .btn-cart:hover {
            background: #b93f00;
            box-shadow: 0 4px 12px rgba(211, 84, 0, 0.4);
        }

        .alert {
            background: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* --- RESPONSIVE MOBILE --- */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            header {
                flex-direction: column;
                text-align: center;
                padding: 20px 15px;
            }

            header h1 {
                justify-content: center;
                font-size: 24px;
            }

            header>div {
                justify-content: center;
            }

            .search-bar {
                flex-direction: column;
            }

            .search-bar button {
                width: 100%;
                justify-content: center;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .card-image-wrapper {
                height: 220px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <a href="/" style="display: flex; align-items: center; text-decoration: none;">
                <div style="background: white; padding: 5px 15px; border-radius: 8px; display: flex; align-items: center;">
                    <img src="{{ asset('images/logo.png') }}" alt="MAGLOIRE" style="height: 45px; width: auto;">
                </div>
            </a>

            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                @auth
                    <a href="{{ route('profile.show') }}" style="color: #fff; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                        <span class="material-symbols-outlined" style="color: #d35400;">person</span> {{ Auth::user()->name }}
                    </a>
                    <a href="{{ route('orders.my') }}" style="background: rgba(255,255,255,0.15); color: white; padding: 8px 15px; border-radius: 30px; text-decoration: none; font-size: 13px; display: flex; align-items: center; gap: 5px;">
                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d35400;">inventory_2</span> Mes commandes
                    </a>
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" style="background: #ffc107; color: #333; padding: 8px 15px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 13px; display: flex; align-items: center; gap: 5px;">
                            <span class="material-symbols-outlined" style="font-size: 16px;">settings</span> Admin
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: transparent; color: white; border: 1px solid rgba(255,255,255,0.4); padding: 8px 15px; border-radius: 30px; cursor: pointer; font-size: 13px; display: flex; align-items: center; gap: 5px;">
                            <span class="material-symbols-outlined" style="font-size: 16px; color: #d35400;">logout</span> Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="background: rgba(255,255,255,0.15); color: white; padding: 8px 18px; border-radius: 30px; text-decoration: none; font-size: 13px;">Connexion</a>
                    <a href="{{ route('register') }}" style="background: #d35400; color: white; padding: 8px 18px; border-radius: 30px; text-decoration: none; font-size: 13px;">Inscription</a>
                @endauth
                <a href="{{ route('cart.index') }}" class="cart-btn">
                    <span class="material-symbols-outlined">shopping_cart</span> Panier
                    <span class="cart-count">{{ count(session('cart', [])) }}</span>
                </a>
            </div>
        </header>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="/" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Rechercher un plat..." value="{{ $search ?? '' }}">
            <button type="submit"><span class="material-symbols-outlined">search</span> Rechercher</button>
        </form>

        <div class="filters">
            <a href="/" class="filter-btn {{ !$currentCategory ? 'active' : '' }}"><span
                    class="material-symbols-outlined">restaurant</span> Tous</a>
            <a href="/?category=Entrée" class="filter-btn {{ $currentCategory === 'Entrée' ? 'active' : '' }}"><span
                    class="material-symbols-outlined">eco</span> Entrées</a>
            <a href="/?category=Plat" class="filter-btn {{ $currentCategory === 'Plat' ? 'active' : '' }}"><span
                    class="material-symbols-outlined">local_pizza</span> Plats</a>
            <a href="/?category=Dessert" class="filter-btn {{ $currentCategory === 'Dessert' ? 'active' : '' }}"><span
                    class="material-symbols-outlined">cake</span> Desserts</a>
            <a href="/?category=Boisson" class="filter-btn {{ $currentCategory === 'Boisson' ? 'active' : '' }}"><span
                    class="material-symbols-outlined">local_drink</span> Boissons</a>
        </div>

        {{-- SECTION PROMOTIONS --}}
        @if ($promoProducts->count() > 0)
            <div style="margin-bottom: 40px;">
                <h2
                    style="color: #d35400; font-size: 24px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; border-bottom: 2px solid #d35400; padding-bottom: 10px;">
                    <span class="material-symbols-outlined" style="font-size: 30px;">local_fire_department</span> Nos
                    Offres Spéciales
                </h2>
                <div class="grid">
                    @foreach ($promoProducts as $product)
                        <div class="card"
                            style="border: 2px solid #d35400; box-shadow: 0 4px 15px rgba(211, 84, 0, 0.2);">
                            <div class="card-image-wrapper">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                <span class="badge">{{ $product->category }}</span>
                                <span class="promo-badge"><span class="material-symbols-outlined"
                                        style="font-size: 14px;">local_fire_department</span> Promo</span>
                            </div>
                            <div class="card-body">
                                <h3>{{ $product->name }}</h3>
                                <p>{{ Str::limit($product->description, 70) }}</p>
                                <div class="price-block">
                                    <span class="price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                    <span class="old-price">{{ number_format($product->old_price, 0, ',', ' ') }}
                                        FCFA</span>
                                </div>
                                <div class="stock">Stock : {{ $product->stock }}</div>
                                <div class="actions">
                                    <a href="/produit/{{ $product->id }}" class="btn"><span
                                            class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                                        Détails</a>
                                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-cart"><span
                                            class="material-symbols-outlined"
                                            style="font-size: 16px;">add_shopping_cart</span> Ajouter</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- SECTION MENU RÉGULIER --}}
        <div style="margin-bottom: 20px;">
            <h2
                style="color: #2c3e50; font-size: 24px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; border-bottom: 2px solid #2c3e50; padding-bottom: 10px;">
                <span class="material-symbols-outlined" style="font-size: 30px;">restaurant_menu</span> Notre Menu
            </h2>
            <div class="grid">
                @forelse ($regularProducts as $product)
                    <div class="card">
                        <div class="card-image-wrapper">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                            <span class="badge">{{ $product->category }}</span>
                            @if ($product->is_new)
                                <span class="new-badge"><span class="material-symbols-outlined"
                                        style="font-size: 14px;">new_releases</span> Nouveau</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ Str::limit($product->description, 70) }}</p>
                            <div class="price-block">
                                <span class="price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="stock">Stock : {{ $product->stock }}</div>
                            <div class="actions">
                                <a href="/produit/{{ $product->id }}" class="btn"><span
                                        class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                                    Détails</a>
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-cart"><span
                                        class="material-symbols-outlined"
                                        style="font-size: 16px;">add_shopping_cart</span> Ajouter</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="grid-column: 1/-1; text-align: center; color: #888; padding: 40px;">Aucun produit trouvé.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
        <footer style="text-align: center; padding: 30px 20px; margin-top: 40px; border-top: 1px solid #e0e0e0; color: #777; font-size: 13px;">
        <p style="margin-bottom: 5px;">&copy; {{ date('Y') }} <strong>MAGLOIRE</strong> - Tous droits réservés.</p>
        <p style="font-size: 11px;">Fait avec coeur ❤️ pour la gastronomie.</p>
    </footer>
</body>

</html>
