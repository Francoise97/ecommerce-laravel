<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - MAGLOIRE</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #fdfbf7; }

        /* --- SIDEBAR DESKTOP --- */
        .sidebar {
            position: fixed; left: 0; top: 0; bottom: 0; width: 240px;
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
            color: white; padding: 25px 0; overflow-y: auto;
        }
        .sidebar h2 {
            padding: 0 25px 20px; font-size: 22px;
            border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar nav a {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 25px; color: rgba(255,255,255,0.7);
            text-decoration: none; font-size: 14px; font-weight: 500;
            transition: all 0.2s; border-left: 3px solid transparent;
        }
        .sidebar nav a .material-symbols-outlined { color: #d35400; font-size: 20px; }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: rgba(255,255,255,0.05); color: white;
            border-left-color: #d35400;
        }

        .main { margin-left: 240px; padding: 30px; }
        .topbar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 30px; padding-bottom: 20px;
            border-bottom: 1px solid #ddd; gap: 20px;
        }
        .topbar h1 { color: #2c3e50; font-size: 24px; }
        .topbar .user-info { display: flex; align-items: center; gap: 15px; font-size: 14px; color: #555; }
        .topbar .user-info .material-symbols-outlined { color: #2c3e50; }

        .alert { background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; }
        .btn {
            display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; border-radius: 8px;
            text-decoration: none; font-size: 14px; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s;
        }
        .btn .material-symbols-outlined { font-size: 18px; }
        .btn-primary { background: #d35400; color: white; }
        .btn-primary:hover { background: #b93f00; }
        .btn-secondary { background: #ddd; color: #333; }
        .btn-secondary:hover { background: #bbb; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-danger:hover { background: #b02a37; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }

        /* --- RESPONSIVE MOBILE --- */
        @media (max-width: 768px) {
            .sidebar { position: relative; width: 100%; height: auto; padding: 15px 0; }
            .sidebar h2 { padding: 0 15px 10px; font-size: 20px; }
            .sidebar nav a { padding: 10px 15px; }
            .main { margin-left: 0; padding: 15px; }
            .topbar { flex-direction: column; align-items: flex-start; gap: 10px; }
            .topbar h1 { font-size: 20px; }
            .card { padding: 15px; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <h2><span class="material-symbols-outlined" style="font-size: 28px;">restaurant</span> MAGLOIRE</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="material-symbols-outlined">dashboard</span> Tableau de bord
            </a>
            <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">restaurant_menu</span> Produits
            </a>
            <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">inventory_2</span> Commandes
                            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">group</span> Clients
            </a>
                @php $pendingCount = \App\Models\Order::where('status', 'En attente')->count(); @endphp
                @if ($pendingCount > 0)
                    <span style="background: #d35400; color: white; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px; margin-left: auto;">
                        {{ $pendingCount }}
                    </span>
                @endif
            </a>
            <a href="{{ route('admin.coupons') }}" class="{{ request()->routeIs('admin.coupons*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">confirmation_number</span> Codes promo
            </a>
            <a href="/" style="margin-top: 25px; padding-top: 25px; border-top: 1px solid rgba(255,255,255,0.1);">
                <span class="material-symbols-outlined">home</span> Voir le site
            </a>
        </nav>
    </aside>

    <main class="main">
        <div class="topbar">
            <h1>@yield('title')</h1>
            <div class="user-info">
                <span><span class="material-symbols-outlined" style="font-size: 18px;">person</span> {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #d35400; cursor: pointer; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 4px;">
                        <span class="material-symbols-outlined" style="font-size: 18px;">logout</span> Déconnexion
                    </button>
                </form>
            </div>
        </div>
        @if (session('success')) <div class="alert">{{ session('success') }}</div> @endif
        @yield('content')
    </main>
</body>
</html>
