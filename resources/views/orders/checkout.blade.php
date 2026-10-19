<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Valider ma commande - MAGLOIRE</title>
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

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        header {
            background: linear-gradient(135deg, #2c3e50 0%,
                    #1a252f 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            text-align: center;
        }

        header h1 {
            font-size: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        header h1 .material-symbols-outlined {
            color: #d35400;
            font-size: 32px;
        }

        .layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .layout {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .card h2 .material-symbols-outlined {
            color: #d35400;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            font-family: inherit;
            transition: border 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #d35400;
        }

        .error {
            color: #d35400;
            font-size: 12px;
            margin-top: 5px;
        }

        .recap-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        .recap-total {
            display: flex;
            justify-content: space-between;
            padding-top: 15px;
            margin-top: 15px;
            border-top: 2px solid #2c3e50;
            font-size: 18px;
            font-weight: bold;
            color: #d35400;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 15px;
            background: #d35400;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.2s;
        }

        .btn:hover {
            background:
                #b93f00;
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
            text-decoration: none;
        }

        .back-link:hover {
            color: #d35400;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1><span class="material-symbols-outlined">receipt_long</span> Valider ma commande</h1>
        </header>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="layout">
                <div class="card">
                    <h2><span class="material-symbols-outlined">person</span> Vos informations</h2>
                    <div class="form-group">
                        <label>Nom complet *</label>
                        <input type="text" name="customer_name"
                            value="{{ old('customer_name', Auth::user()->name) }}" required>
                        @error('customer_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Téléphone *</label>
                        <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required>
                        @error('customer_phone')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email (optionnel)</label>
                        <input type="email" name="customer_email"
                            value="{{ old('customer_email', Auth::user()->email) }}">
                        @error('customer_email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Adresse de livraison *</label>
                        <textarea name="customer_address" rows="3" required>{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card">
                    <h2><span class="material-symbols-outlined">shopping_basket</span> Récapitulatif</h2>
                    @foreach ($cart as $item)
                        <div class="recap-item">
                            <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                            <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FCFA</span>
                        </div>
                    @endforeach
                    <div class="recap-total">
                        <span>Total</span>
                        <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn"><span class="material-symbols-outlined">check_circle</span> Confirmer
                ma commande</button>
        </form>
        <a href="{{ route('cart.index') }}" class="back-link"><span class="material-symbols-outlined"
                style="font-size: 18px;">arrow_back</span> Retour au panier</a>
    </div>
</body>

</html>
