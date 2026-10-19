<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCouponController;

/*
|--------------------------------------------------------------------------
| ACCUEIL + CATALOGUE
|--------------------------------------------------------------------------
*/

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

    $order = ['Entrée' => 1, 'Plat' => 2, 'Dessert' => 3, 'Boisson' => 4];
    $allProducts = $query->get()->sortBy(function ($product) use ($order) {
        return ($order[$product->category] ?? 99) . '_' . $product->name;
    })->values();

    $promoProducts = $allProducts->filter(fn($p) => $p->is_on_promo);
    $regularProducts = $allProducts->reject(fn($p) => $p->is_on_promo);

    return view('products.index', [
        'promoProducts' => $promoProducts,
        'regularProducts' => $regularProducts,
        'currentCategory' => $category,
        'search' => $search,
    ]);
});

Route::get('/produit/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return view('products.show', ['product' => $product]);
})->name('products.show');

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

// Inscription / Connexion
Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
Route::post('/inscription', [AuthController::class, 'register']);
Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login']);
Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

// Mot de passe oublié
Route::get('/mot-de-passe-oublie', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/mot-de-passe-oublie', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])->name('password.update'); // J'ai renommé 'reset' en 'updatePassword' pour éviter le conflit avec la méthode PHP

/*
|--------------------------------------------------------------------------
| ESPACE CLIENT (Connecté obligatoire)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Panier
    Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
    Route::get('/panier/ajouter/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/panier/retirer/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

    // Codes Promo
    Route::post('/panier/coupon/appliquer', [CouponController::class, 'apply'])->name('coupon.apply');
    Route::get('/panier/coupon/retirer', [CouponController::class, 'remove'])->name('coupon.remove');

    // Commandes
    Route::get('/commande', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/commande', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/commande/confirmation/{id}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.my');

    // Profil Client
    Route::get('/mon-profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/mon-profil', [ProfileController::class, 'update'])->name('profile.update');

    // Facture PDF
    Route::get('/commande/{id}/facture', [App\Http\Controllers\InvoiceController::class, 'download'])->name('orders.invoice');
});

/*
|--------------------------------------------------------------------------
| ESPACE ADMIN (Admin obligatoire)
|--------------------------------------------------------------------------
*/

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

    // Clients
    Route::get('/clients', [AdminController::class, 'users'])->name('users');
    Route::get('/clients/{id}/commandes', [AdminController::class, 'userOrders'])->name('users.orders');

    // Codes promo
    Route::get('/coupons', [AdminCouponController::class, 'index'])->name('coupons');
    Route::get('/coupons/ajouter', [AdminCouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons/ajouter', [AdminCouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{id}/modifier', [AdminCouponController::class, 'edit'])->name('coupons.edit');
    Route::post('/coupons/{id}/modifier', [AdminCouponController::class, 'update'])->name('coupons.update');
    Route::get('/coupons/{id}/supprimer', [AdminCouponController::class, 'destroy'])->name('coupons.destroy');
    Route::get('/coupons/{id}/toggle', [AdminCouponController::class, 'toggle'])->name('coupons.toggle');
});
