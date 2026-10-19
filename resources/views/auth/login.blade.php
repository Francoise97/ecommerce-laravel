<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - MAGLOIRE</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { background: white; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        h1 { color: #2c3e50; margin-bottom: 5px; font-size: 28px; text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px; }
        h1 .material-symbols-outlined { color: #d35400; font-size: 32px; }
        .subtitle { color: #888; text-align: center; margin-bottom: 30px; font-size: 14px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 600; color: #333; font-size: 14px; }
        .form-group input[type="email"], .form-group input[type="password"] { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; outline: none; transition: border 0.2s; }
        .form-group input:focus { border-color: #d35400; }
        .remember-group { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .remember-group input { width: 18px; height: 18px; cursor: pointer; }
        .remember-group label { margin: 0; font-weight: normal; font-size: 14px; color: #555; cursor: pointer; }
        .btn { display: flex; align-items: center; justify-content: center; gap: 5px; width: 100%; padding: 14px; background: #d35400; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s; margin-top: 10px; }
        .btn:hover { background: #b93f00; }
        .link { display: block; text-align: center; margin-top: 20px; color: #666; font-size: 14px; text-decoration: none; }
        .link a { color: #d35400; font-weight: 600; text-decoration: none; }
        .forgot-link { display: block; text-align: center; margin-top: 15px; font-size: 13px; color: #888; text-decoration: none; }
        .forgot-link:hover { color: #d35400; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 12px 15px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; }
        .alert-success { background: #d4edda; color: #155724; padding: 12px 15px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; text-align: center; }
        .back-home { display: flex; align-items: center; justify-content: center; gap: 5px; text-align: center; margin-top: 15px; color: #aaa; text-decoration: none; font-size: 13px; }
        .back-home:hover { color: #666; }
    </style>
</head>
<body>
    <div class="card">
        <h1><span class="material-symbols-outlined">lock</span> Connexion</h1>
        <p class="subtitle">Content de vous revoir !</p>

        @if (session('success')) <div class="alert-success">{{ session('success') }}</div> @endif
        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>

            <div class="remember-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="btn">
                <span class="material-symbols-outlined">login</span> Se connecter
            </button>
        </form>

        <a href="{{ route('password.request') }}" class="forgot-link">Mot de passe oublié ?</a>
        <p class="link">Pas encore de compte ? <a href="{{ route('register') }}">Inscrivez-vous</a></p>
        <a href="/" class="back-home"><span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span> Retour au restaurant</a>
    </div>
</body>
</html>
