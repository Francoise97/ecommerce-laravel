<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon profil - MAGLOIRE</title>
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
            padding: 25px 30px;
            margin-bottom: 25px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 26px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        header h1 .material-symbols-outlined {
            color: #d35400;
            font-size: 32px;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 10px 18px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title .material-symbols-outlined {
            color: #d35400;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            border-color: #d35400;
        }

        .form-group small {
            display: block;
            margin-top: 5px;
            color: #999;
            font-size: 12px;
        }

        .error {
            color: #d35400;
            font-size: 13px;
            margin-top: 5px;
        }

        .divider {
            margin: 30px 0;
            border-top: 1px dashed #ddd;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px;
            background: #d35400;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn:hover {
            background:
                #b93f00;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1><span class="material-symbols-outlined">person</span> Mon profil</h1>
            <a href="/" class="back-btn"><span class="material-symbols-outlined"
                    style="font-size: 18px;">arrow_back</span> Retour au menu</a>
        </header>

        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="section-title"><span class="material-symbols-outlined">badge</span> Informations
                    personnelles</div>
                <div class="form-group">
                    <label>Nom complet</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Adresse email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                </div>

                <div class="divider"></div>

                <div class="section-title"><span class="material-symbols-outlined">lock</span> Changer le mot de passe
                </div>
                <div class="form-group">
                    <label>Mot de passe actuel</label>
                    <input type="password" name="current_password" placeholder="Laissez vide pour ne pas changer">
                    <small>Requis uniquement si vous changez de mot de passe.</small>
                    @error('current_password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nouveau mot de passe</label>
                    <input type="password" name="new_password" placeholder="Laissez vide pour ne pas changer">
                    <small>Minimum 6 caractères.</small>
                    @error('new_password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirmer le nouveau mot de passe</label>
                    <input type="password" name="new_password_confirmation"
                        placeholder="Retapez le nouveau mot de passe">
                </div>

                <button type="submit" class="btn"><span class="material-symbols-outlined">save</span> Enregistrer
                    les modifications</button>
            </form>
        </div>
    </div>
</body>

</html>
