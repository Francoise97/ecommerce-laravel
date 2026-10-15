<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Afficher le formulaire de commande
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    // Enregistrer la commande
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email',
            'customer_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('success', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Créer la commande
       $order = Order::create([
    'user_id' => \Illuminate\Support\Facades\Auth::id(),
    'customer_name' => $request->customer_name,
    'customer_phone' => $request->customer_phone,
    'customer_email' => $request->customer_email,
    'customer_address' => $request->customer_address,
    'total' => $total,
    'status' => 'En attente',
]);


        // Créer les articles
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

            // Décrémenter le stock
            $product = Product::find($productId);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        // Vider le panier
        session()->forget('cart');

        return redirect()->route('orders.confirmation', $order->id);
    }

    // Historique des commandes du client connecté
public function myOrders()
{
    $orders = \App\Models\Order::with('items')
        ->where('user_id', \Illuminate\Support\Facades\Auth::id())
        ->latest()
        ->get();

    return view('orders.my-orders', compact('orders'));
}
    // Page de confirmation
    public function confirmation($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('orders.confirmation', compact('order'));
    }
}
