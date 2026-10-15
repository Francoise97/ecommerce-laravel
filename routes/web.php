<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

// ===== ACCUEIL + CATALOGUE =====
Route::get('/', function (Request $request) {
    $category = $request->query('category');
    $search = $request->query('search');

    $query = Product::query();

    if ($category) {
        $query->where('category', $category);
    }

    if ($search) {
        $query->where('name', 'LIKE', '%' . $search . '%');
    }

    $products = $query->get();

    return view('products.index', [
        'products' => $products,
        'currentCategory' => $category,
        'search' => $search,
    ]);
});

Route::get('/produit/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return view('products.show', ['product' => $product]);
});

// ===== PANIER =====
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::get('/panier/ajouter/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/panier/retirer/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

// ===== COMMANDES =====
Route::get('/commande', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/commande', [OrderController::class, 'store'])->name('orders.store');
Route::get('/commande/confirmation/{id}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.my')->middleware('auth');

// ===== AUTHENTIFICATION =====
Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
Route::post('/inscription', [AuthController::class, 'register']);
Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login']);
Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

// ===== ADMIN (protégé) =====
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Commandes
    Route::get('/commandes', [AdminController::class, 'orders'])->name('orders');
    Route::get('/commandes/{id}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::post('/commandes/{id}/statut', [AdminController::class, 'updateOrderStatus'])->name('orders.status');

    // Produits
    Route::get('/produits', [AdminController::class, 'products'])->name('products');
    Route::get('/produits/ajouter', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/produits/ajouter', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/produits/{id}/modifier', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::post('/produits/{id}/modifier', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::get('/produits/{id}/supprimer', [AdminController::class, 'destroyProduct'])->name('products.destroy');
});
