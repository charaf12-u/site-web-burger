<?php
// backend/api/setup_admin.php
require_once 'db.php';

$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?) ON DUPLICATE KEY UPDATE password = ?");
    $stmt->execute([$username, $hashed_password, $hashed_password]);
    echo "Administrateur créé/mis à jour avec succès !<br>";
    echo "Utilisateur : <b>admin</b><br>";
    echo "Mot de passe : <b>admin123</b><br><br>";
    echo "<i>Veuillez supprimer ce fichier après utilisation pour la sécurité.</i>";
} catch (PDOException $e) {
    echo "Erreur lors de la création de l'admin : " . $e->getMessage();
}
