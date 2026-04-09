# 🍔 Gourmet BURGER | L'excellence Culinaire

![Gourmet Burger](frontend/assets/img/screenshot.png)

Un site web full-stack moderne et élégant pour un restaurant de burgers haut de gamme. Ce projet a été conçu pour offrir une expérience utilisateur fluide et immersive pour les clients et un panneau de gestion puissant pour les administrateurs.

---

## ✨ Fonctionnalités

### Côté Client (Frontend)
- **Menu Interactif** : Panier d'achat en temps réel (stocké dans le LocalStorage).
- **Commande en ligne** : Les clients peuvent passer une commande directement via un formulaire Modal.
- **Pages Détaillées** : Accueil, Ingrédients, Histoire, FAQ et Contact.
- **Design Premium** : "Glassmorphism", animations fluides et typographie premium (Google Fonts *Playfair Display* & *Inter*).
- **Entièrement Responsive** : Parfaite compatibilité Mobile, Tablette et PC.

### Côté Serveur (Backend & Admin)
- **API REST locale** : Développée en PHP pur pour interagir avec le Frontend (`/backend/api/`).
- **Dashboard Admin** : Une interface sécurisée permettant de consulter, valider et supprimer les commandes et les messages de contact.
- **Base de données MySQL** : Stockage persistant pour les commandes, les contacts client et les accès administrateur.
- **Fichier d'environnement** : Configuration via un fichier `.env`.

---

## 🛠️ Technologies Utilisées

- **Frontend** : HTML5, CSS3, JavaScript (Vanilla), Bootstrap CSS (pour la grille).
- **Backend** : PHP 8+ (Natifs / API procédurale).
- **Base de Données** : MySQL (gérée via PDO).

---

## 📁 Structure du Projet

```text
/site-web-burger
│
├── frontend/                 # Tout le contenu vu par le client
│   ├── assets/img/           # Images et ressources visuelles
│   ├── css/                  # Styles personnalisés et reset (style.css, bootstrap.css)
│   ├── admin/                # Dashboard et pages de connexion (login.html, index.html)
│   └── (html files)          # Pages du site (contact.html, faq.html, histoire.html...)
│
├── backend/                  # Scripts serveur et accès DB
│   ├── api/                  # Fichiers PHP (orders.php, contact.php, db.php...)
│   ├── .env                  # Configuration de la base de données
│   └── database.sql          # Structure SQL pour initialiser la DB
│
├── index.html                # Page d'accueil racine (Single-Page like)
└── README.md                 # Documentation du projet
```

---

## 🚀 Installation et Démarrage

Le projet nécessitant PHP et MySQL, vous devez utiliser un environnement serveur local tel que **MAMP**, **XAMPP**, ou **WAMP**.

### 1. Préparation des Fichiers
1. Clonez ce dépôt.
   ```bash
   git clone https://github.com/charaf12-u/site-web-burger.git
   ```
2. Placez le dossier `site-web-burger` dans le dossier public de votre serveur local :
   - MAMP : Généralement `C:\MAMP\htdocs\` (ou `/Applications/MAMP/htdocs/` sur Mac)
   - XAMPP/WAMP : Généralement `htdocs/` ou `www/`

### 2. Configuration de la Base de Données
1. Lancez votre serveur MySQL via votre interface (MAMP/XAMPP).
2. Ouvrez PhpMyAdmin (souvent accessible à l'url `http://localhost/phpmyadmin`).
3. Importez le fichier SQL présent dans `backend/database.sql`.
   *(Il va créer la base `burger_db`, les tables `orders`, `contacts`, et `admins`, et injecter le compte administrateur)*.

### 3. Fichier d'Environnement
Vérifiez que le fichier `backend/.env` correspond à votre configuration MySQL locale :
```env
DB_HOST=localhost
DB_NAME=burger_db
DB_USER=root
DB_PASS=root
```
*(Note : Sous WAMP/XAMPP, le DB_PASS est souvent vide `DB_PASS=`)*

### 4. Démarrage
Ouvrez le site dans le navigateur (Ne l'ouvrez **PAS** directement comme fichier local `file://`) :
```text
http://localhost/site-web-burger/
```

---

## 🔒 Accès Administrateur

Pour voir les commandes qui ont été passées et lire les messages de contact :
1. Allez sur **`http://localhost/site-web-burger/frontend/admin/login.html`**
2. Connectez-vous avec les accès par défaut :
   - **Utilisateur** : `admin`
   - **Mot de passe** : `admin123`

> **Note de debug :** Si l'accès `admin` ne fonctionne pas, rendez-vous d'abord à l'adresse URL : `http://localhost/site-web-burger/backend/api/setup_admin.php` pour forcer la création du compte administrateur par défaut dans la BDD, puis supprimez ce fichier pour des raisons de sécurité.

---
Conçu par **Gourmet BURGER**.
