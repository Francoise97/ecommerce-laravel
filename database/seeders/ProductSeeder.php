<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ne pas recréer les produits s'ils existent déjà
        if (Product::count() > 0) {
            return;
        }

        $products = [
            // ENTRÉES
            ['name' => 'Salade César', 'description' => 'Salade croquante avec poulet grillé, croûtons, parmesan et sauce César maison.', 'price' => 3500, 'old_price' => null, 'stock' => 20, 'category' => 'Entrée', 'image' => 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?w=400'],
            ['name' => 'Soupe à l\'oignon', 'description' => 'Soupe à l\'oignon gratinée au fromage, recette traditionnelle.', 'price' => 2000, 'old_price' => 2500, 'stock' => 15, 'category' => 'Entrée', 'image' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400'],
            ['name' => 'Bruschetta', 'description' => 'Pain grillé garni de tomates fraîches, basilic et huile d\'olive.', 'price' => 2000, 'old_price' => null, 'stock' => 25, 'category' => 'Entrée', 'image' => 'https://images.unsplash.com/photo-1572695157366-5e585ab2b69f?w=400'],

            // PLATS
            ['name' => 'Pizza Margherita', 'description' => 'Pizza italienne avec sauce tomate, mozzarella fondante et basilic frais.', 'price' => 4500, 'old_price' => 6000, 'stock' => 30, 'category' => 'Plat', 'image' => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=400'],
            ['name' => 'Burger Royal', 'description' => 'Burger avec steak haché 150g, cheddar, salade, tomate, oignons et sauce maison.', 'price' => 5500, 'old_price' => null, 'stock' => 20, 'category' => 'Plat', 'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400'],
            ['name' => 'Pâtes Carbonara', 'description' => 'Spaghetti à la sauce crémeuse, lardons fumés, parmesan et jaune d\'œuf.', 'price' => 4000, 'old_price' => 5000, 'stock' => 18, 'category' => 'Plat', 'image' => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=400'],
            ['name' => 'Poulet Rôti', 'description' => 'Demi-poulet rôti aux herbes de Provence, servi avec frites maison.', 'price' => 7000, 'old_price' => null, 'stock' => 12, 'category' => 'Plat', 'image' => 'https://images.unsplash.com/photo-1610057099443-fde8c4d50f91?w=400'],

            // DESSERTS
            ['name' => 'Tiramisu', 'description' => 'Dessert italien au café, mascarpone et cacao, préparé maison.', 'price' => 2500, 'old_price' => null, 'stock' => 15, 'category' => 'Dessert', 'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=400'],
            ['name' => 'Crème Brûlée', 'description' => 'Crème vanille onctueuse avec une croûte caramélisée croustillante.', 'price' => 1500, 'old_price' => 2000, 'stock' => 10, 'category' => 'Dessert', 'image' => 'https://images.unsplash.com/photo-1470124182917-cc6e71b22ecc?w=400'],

            // BOISSONS
            ['name' => 'Coca-Cola', 'description' => 'Canette de Coca-Cola 33cl, servie bien fraîche.', 'price' => 1000, 'old_price' => null, 'stock' => 100, 'category' => 'Boisson', 'image' => 'https://images.unsplash.com/photo-1554866585-cd94860890b7?w=400'],
            ['name' => 'Jus d\'orange frais', 'description' => 'Jus d\'orange pressé minute, 100% naturel.', 'price' => 1500, 'old_price' => null, 'stock' => 40, 'category' => 'Boisson', 'image' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400'],
            ['name' => 'Café Espresso', 'description' => 'Café espresso italien, intense et aromatique.', 'price' => 800, 'old_price' => null, 'stock' => 50, 'category' => 'Boisson', 'image' => 'https://images.unsplash.com/photo-1510707577719-ae7c14805e3a?w=400'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
