<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page non trouvée - Mon Restaurant</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 20px; color: white;
        }
        .container {
            text-align: center; max-width: 600px;
        }
        .emoji {
            font-size: 120px; margin-bottom: 20px;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        h1 {
            font-size: 80px; font-weight: 800;
            color: #e94560; margin-bottom: 10px;
            letter-spacing: 5px;
        }
        h2 {
            font-size: 28px; margin-bottom: 15px;
            font-weight: 600;
        }
        p {
            color: rgba(255,255,255,0.7); font-size: 16px;
            margin-bottom: 30px; line-height: 1.6;
        }
        .btn {
            display: inline-block;
            padding: 15px 35px;
            background: #e94560; color: white;
            border-radius: 30px; text-decoration: none;
            font-weight: 700; font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(233, 69, 96, 0.4);
        }
        .btn:hover {
            background: #c73650;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(233, 69, 96, 0.6);
        }
        .suggestions {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .suggestions p {
            font-size: 14px; margin-bottom: 15px;
        }
        .suggestions a {
            display: inline-block;
            color: #e94560;
            text-decoration: none;
            margin: 5px 10px;
            font-size: 14px;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        .suggestions a:hover { opacity: 0.7; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="emoji">🍽️</div>
        <h1>404</h1>
        <h2>Oups ! Cette page n'existe pas</h2>
        <p>
            Il semble que le plat que vous cherchez ait été retiré du menu...<br>
            Ou peut-être avez-vous pris une mauvaise direction ?
        </p>
        <a href="/" class="btn">🏠 Retour au menu</a>

        <div class="suggestions">
            <p>Vous cherchiez peut-être :</p>
            <a href="/">🍕 Le catalogue</a>
            <a href="/panier">🛒 Mon panier</a>
            <a href="/mes-commandes">📦 Mes commandes</a>
        </div>
    </div>
</body>
</html>
