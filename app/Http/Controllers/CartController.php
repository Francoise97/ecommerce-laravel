<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Afficher le panier
public function index()
{
    $cart = session()->get('cart', []);
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    // Appliquer le coupon si présent
    $coupon = session('coupon');
    $discount = 0;
    if ($coupon) {
        // Recharger le coupon pour recalculer la réduction
        $couponModel = \App\Models\Coupon::find($coupon['id']);
        if ($couponModel && $couponModel->isValid()) {
            $discount = $couponModel->calculateDiscount($subtotal);
        } else {
            // Coupon devenu invalide → retirer
            session()->forget('coupon');
            $coupon = null;
        }
    }

    $total = $subtotal - $discount;

    return view('cart.index', compact('cart', 'subtotal', 'coupon', 'discount', 'total'));
}

    // Ajouter un produit au panier
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    // Retirer un produit
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }

    // Vider le panier
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Panier vidé.');
    }
}
