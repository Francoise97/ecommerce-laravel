<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard avec statistiques
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_users' => User::where('is_admin', false)->count(),
            'total_revenue' => Order::sum('total'),
            'pending_orders' => Order::where('status', 'En attente')->count(),
        ];

        $recentOrders = Order::with('items')->latest()->take(5)->get();
        $lowStockProducts = Product::where('stock', '<', 10)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockProducts'));
    }

    // ==================== COMMANDES ====================

    public function orders(Request $request)
{
    $status = $request->query('status');

    $query = Order::with('items');

    if ($status) {
        $query->where('status', $status);
    }

    $orders = $query->latest()->get();

    // Compter par statut pour les badges
    $counts = [
        'all' => Order::count(),
        'En attente' => Order::where('status', 'En attente')->count(),
        'En préparation' => Order::where('status', 'En préparation')->count(),
        'En livraison' => Order::where('status', 'En livraison')->count(),
        'Livrée' => Order::where('status', 'Livrée')->count(),
        'Annulée' => Order::where('status', 'Annulée')->count(),
    ];

    return view('admin.orders.index', compact('orders', 'status', 'counts'));
}

    public function showOrder($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Statut mis à jour.');
    }

    // ==================== PRODUITS ====================

    // Liste des produits
   public function products(Request $request)
{
    $search = $request->query('search');
    $category = $request->query('category');

    $query = Product::query();

    if ($search) {
        $query->where('name', 'LIKE', '%' . $search . '%');
    }

    if ($category) {
        $query->where('category', $category);
    }

    $products = $query->latest()->get();

    return view('admin.products.index', compact('products', 'search', 'category'));
}

    // Formulaire de création
    public function createProduct()
    {
        return view('admin.products.create');
    }

    // Enregistrer un nouveau produit
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except('image');

        // Upload de l'image si présente
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Produit ajouté avec succès !');
    }

    // Formulaire d'édition
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Mettre à jour un produit
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->except('image');

        // Nouvelle image uploadée ?
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne si c'est un fichier local
            if ($product->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Produit modifié avec succès !');
    }

    // Supprimer un produit
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        // Supprimer le fichier image s'il s'agit d'un upload local
        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produit supprimé.');
    }
}
