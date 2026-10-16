# 🍽️MAGLOIRE - Site E-commerce Laravel

Un site e-commerce complet pour un restaurant, développé avec **Laravel 13** et une base de données **SQLite**. Ce projet a été réalisé dans le cadre d'un projet d'études.

---

## 📋 Fonctionnalités

### 🌐 Côté Client
- **Catalogue de produits** avec filtres par catégorie (Entrées, Plats, Desserts, Boissons)
- **Recherche** de produits par nom
- **Badges visuels** : 🆕 Nouveau (produits récents), 🔥 Promo (prix barrés)
- **Panier** : ajout, retrait, vidage, compteur en temps réel
- **Codes promo** : application de réductions (% ou montant fixe)
- **Commande** : formulaire client + page de confirmation
- **Inscription / Connexion / Déconnexion**
- **Mon profil** : modification du nom, email et mot de passe
- **Mes commandes** : historique des commandes passées avec statut

### 🔐 Côté Admin
- **Tableau de bord** avec statistiques (CA, commandes, produits, clients)
- **Gestion des produits** : ajout, modification, suppression + upload d'images
- **Recherche et filtre** dans la liste des produits
- **Gestion des commandes** : filtres par statut, changement de statut en temps réel
- **Gestion des codes promo** : création, modification, activation/désactivation, copie en 1 clic
- **Badge compteur** des commandes en attente dans la sidebar

### 🎨 Design
- Interface moderne et responsive
- Palette de couleurs cohérente (rouge #e94560 et bleu nuit #1a1a2e)
- Pages d'erreur personnalisées (404)
- Animations et effets de survol

---

## 🚀 Installation

### Prérequis
- **PHP** >= 8.2
- **Composer**
- **Node.js** (optionnel)

### Étapes

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/Francoise97/ecommerce-laravel.git
   cd ecommerce-laravel
