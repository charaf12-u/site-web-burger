-- Fichier SQL pour initialiser la base de données (backend/database.sql)

CREATE DATABASE IF NOT EXISTS burger_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE burger_db;

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product TEXT NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    address TEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    sujet VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion de l'administrateur par défaut (mot de passe: admin123)
-- PHP: password_hash("admin123", PASSWORD_DEFAULT)
INSERT INTO admins (username, password) VALUES ('admin', '$2y$10$8C7v7c8C2O.e8u8u8u8u8u8u8u8u8u8u8u8u8u8u8u8u8u8u8u8u8u');
