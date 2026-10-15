<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // Appliquer un code promo
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        // Chercher le coupon par code (insensible à la casse)
        $coupon = Coupon::where('code', strtoupper(trim($request->code)))->first();

        // Le code existe ?
        if (!$coupon) {
            return redirect()->back()->with('error', 'Code promo invalide.');
        }

        // Le code est encore valide ?
        if (!$coupon->isValid()) {
            return redirect()->back()->with('error', 'Ce code promo n\'est plus valide.');
        }

        // Vérifier le montant minimum du panier
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($total < $coupon->min_amount) {
            return redirect()->back()->with('error',
                'Ce code est valable à partir de ' . number_format($coupon->min_amount, 0, ',', ' ') . ' FCFA.'
            );
        }

        // Stocker le coupon en session
        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'formatted_value' => $coupon->formatted_value,
        ]);

        return redirect()->back()->with('success', 'Code promo appliqué : ' . $coupon->formatted_value);
    }

    // Retirer le code promo
    public function remove()
    {
        session()->forget('coupon');
        return redirect()->back()->with('success', 'Code promo retiré.');
    }
}
