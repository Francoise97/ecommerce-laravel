<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin -MAGLOIRE</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f5f5;
        }

        /* === SIDEBAR === */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 240px;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 25px 0;
            overflow-y: auto;
        }

        .sidebar h2 {
            padding: 0 25px 20px;
            font-size: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 25px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            border-left-color: #e94560;
        }

        /* === CONTENU PRINCIPAL === */
        .main {
            margin-left: 240px;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
            gap: 20px;
        }

        .topbar h1 {
            color: #1a1a2e;
            font-size: 24px;
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            color: #555;
        }

        /* === ALERTES === */
        .alert {
            background: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* === BOUTONS === */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #e94560;
            color: white;
        }

        .btn-primary:hover {
            background: #c73650;
        }

        .btn-secondary {
            background: #ddd;
            color: #333;
        }

        .btn-secondary:hover {
            background: #bbb;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #b02a37;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* === CARTES === */
        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <h2>🍽️ Admin Resto</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                📊 Tableau de bord
            </a>
            <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                🍕 Produits
            </a>
            <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                📦 Commandes
                @php $pendingCount = \App\Models\Order::where('status', 'En attente')->count(); @endphp
                @if ($pendingCount > 0)
                <span style="background: #e94560; color: white; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px; margin-left: auto;">
                    {{ $pendingCount }}
                </span>
                @endif
            </a>
            <a href="{{ route('admin.coupons') }}" class="{{ request()->routeIs('admin.coupons*') ? 'active' : '' }}">
                🎟️ Codes promo
            </a>
            <a href="/" style="margin-top: 25px; padding-top: 25px; border-top: 1px solid rgba(255,255,255,0.1);">
                🏠 Voir le site
            </a>
        </nav>
    </aside>

    <main class="main">
        <div class="topbar">
            <h1>@yield('title')</h1>
            <div class="user-info">
                <span>👤 {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #e94560; cursor: pointer; font-weight: 600; font-size: 14px;">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>

</html>