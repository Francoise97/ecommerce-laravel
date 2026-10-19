<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page non trouvée - MAGLOIRE</title>
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
            background: linear-gradient(135deg, #2c3e50 0%,
                    #1a252f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
        }

        .container {
            text-align: center;
            max-width: 600px;
        }

        .icon-big {
            font-size: 120px;
            color: #d35400;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        h1 {
            font-size: 80px;
            font-weight: 800;
            color: #d35400;
            margin-bottom: 10px;
            letter-spacing: 5px;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 15px 35px;
            background: #d35400;
            color: white;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(233, 69, 96, 0.4);
        }

        .btn:hover {
            background:
                #b93f00;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(233, 69, 96, 0.6);
        }

        .suggestions {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .suggestions p {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .suggestions a {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #d35400;
            text-decoration: none;
            margin: 5px 10px;
            font-size: 14px;
            font-weight: 600;
            transition: opacity 0.2s;
        }

        .suggestions a:hover {
            opacity: 0.7;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <span class="material-symbols-outlined icon-big">search_off</span>
        <h1>404</h1>
        <h2>Oups ! Cette page n'existe pas</h2>
        <p>Il semble que le plat que vous cherchez ait été retiré du menu...<br>Ou peut-être avez-vous pris une mauvaise
            direction ?</p>
        <a href="/" class="btn"><span class="material-symbols-outlined">home</span> Retour au menu</a>

        <div class="suggestions">
            <p>Vous cherchiez peut-être :</p>
            <a href="/"><span class="material-symbols-outlined" style="font-size: 16px;">restaurant_menu</span> Le
                catalogue</a>
            <a href="/panier"><span class="material-symbols-outlined" style="font-size: 16px;">shopping_cart</span> Mon
                panier</a>
            <a href="/mes-commandes"><span class="material-symbols-outlined" style="font-size: 16px;">inventory_2</span>
                Mes commandes</a>
        </div>
    </div>
</body>

</html>
