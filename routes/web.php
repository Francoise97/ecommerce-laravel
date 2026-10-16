<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AdminCouponController;
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

    // Trier par catégorie (Entrée → Plat → Dessert → Boisson) puis par nom
    $order = [
        'Entrée' => 1,
        'Plat' => 2,
        'Dessert' => 3,
        'Boisson' => 4,
    ];

    $products = $query->get()->sortBy(function ($product) use ($order) {
        return ($order[$product->category] ?? 99) . '_' . $product->name;
    })->values();

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

// ===== AUTHENTIFICATION =====
Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
Route::post('/inscription', [AuthController::class, 'register']);
Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login']);
Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

// ===== PANIER + COMMANDES (protégé par auth) =====
Route::middleware(['auth'])->group(function () {
    // Panier
    Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
    Route::get('/panier/ajouter/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/panier/retirer/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

    // Coupons
    Route::post('/panier/coupon/appliquer', [CouponController::class, 'apply'])->name('coupon.apply');
    Route::get('/panier/coupon/retirer', [CouponController::class, 'remove'])->name('coupon.remove');
    // Profil client
    Route::get('/mon-profil', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/mon-profil', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    // Commandes
    Route::get('/commande', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/commande', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/commande/confirmation/{id}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.my');
});

// ===== ADMIN (protégé par admin) =====
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
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

    // Coupons
    Route::get('/coupons', [AdminCouponController::class, 'index'])->name('coupons');
    Route::get('/coupons/ajouter', [AdminCouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons/ajouter', [AdminCouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{id}/modifier', [AdminCouponController::class, 'edit'])->name('coupons.edit');
    Route::post('/coupons/{id}/modifier', [AdminCouponController::class, 'update'])->name('coupons.update');
    Route::get('/coupons/{id}/supprimer', [AdminCouponController::class, 'destroy'])->name('coupons.destroy');
    Route::get('/coupons/{id}/toggle', [AdminCouponController::class, 'toggle'])->name('coupons.toggle');
});
