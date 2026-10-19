<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau mot de passe - MAGLOIRE</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { background: white; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        h1 { color: #2c3e50; margin-bottom: 5px; font-size: 26px; text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px; }
        h1 .material-symbols-outlined { color: #d35400; font-size: 32px; }
        .subtitle { color: #888; text-align: center; margin-bottom: 30px; font-size: 14px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 600; color: #333; font-size: 14px; }
        .form-group input { width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; outline: none; }
        .form-group input:focus { border-color: #d35400; }
        .btn { display: flex; align-items: center; justify-content: center; gap: 5px; width: 100%; padding: 14px; background: #d35400; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 10px; }
        .btn:hover { background: #b93f00; }
        .alert-error { background: #f8d7da; color: #721c24; padding: 12px 15px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="card">
        <h1><span class="material-symbols-outlined">key</span> Nouveau mot de passe</h1>
        <p class="subtitle">Choisissez un nouveau mot de passe sécurisé.</p>

        @if ($errors->any()) <div class="alert-error">{{ $errors->first() }}</div> @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $email) }}" required readonly style="background: #f8f9fa; color: #888;">
            </div>
            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" name="password" required autofocus>
            </div>
            <div class="form-group">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn"><span class="material-symbols-outlined">save</span> Réinitialiser</button>
        </form>
    </div>
</body>
</html>
