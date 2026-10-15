<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Valider ma commande</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f5f0; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: white; padding: 25px; border-radius: 12px;
            margin-bottom: 25px; text-align: center;
        }
        header h1 { font-size: 26px; }
        .layout { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 768px) { .layout { grid-template-columns: 1fr; } }

        .card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card h2 { color: #1a1a2e; margin-bottom: 20px; font-size: 20px; }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; color: #333; font-size: 14px; }
        .form-group input, .form-group textarea {
            width: 100%; padding: 10px 15px; border: 2px solid #e0e0e0;
            border-radius: 8px; font-size: 14px; outline: none;
            transition: border 0.2s; font-family: inherit;
        }
        .form-group input:focus, .form-group textarea:focus { border-color: #e94560; }
        .error { color: #e94560; font-size: 12px; margin-top: 5px; }

        .recap-item {
            display: flex; justify-content: space-between;
            padding: 10px 0; border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }
        .recap-item:last-child { border-bottom: none; }
        .recap-total {
            display: flex; justify-content: space-between;
            padding-top: 15px; margin-top: 15px;
            border-top: 2px solid #1a1a2e;
            font-size: 18px; font-weight: bold; color: #e94560;
        }

        .btn {
            display: block; width: 100%; padding: 14px;
            background: #e94560; color: white; border: none;
            border-radius: 8px; font-size: 16px; font-weight: 600;
            cursor: pointer; margin-top: 20px; transition: background 0.2s;
        }
        .btn:hover { background: #c73650; }

        .back-link { display: block; text-align: center; margin-top: 15px; color: #666; font-size: 14px; text-decoration: none; }
        .back-link:hover { color: #e94560; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📝 Valider ma commande</h1>
        </header>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="layout">
                <div class="card">
                    <h2>👤 Vos informations</h2>

                    <div class="form-group">
                        <label>Nom complet *</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required>
                        @error('customer_name') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Téléphone *</label>
                        <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required>
                        @error('customer_phone') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Email (optionnel)</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}">
                        @error('customer_email') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Adresse de livraison *</label>
                        <textarea name="customer_address" rows="3" required>{{ old('customer_address') }}</textarea>
                        @error('customer_address') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="card">
                    <h2>🧾 Récapitulatif</h2>
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

            <button type="submit" class="btn">✅ Confirmer ma commande</button>
        </form>
        <a href="{{ route('cart.index') }}" class="back-link">← Retour au panier</a>
    </div>
</body>
</html>
