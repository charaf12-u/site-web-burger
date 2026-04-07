<?php
// backend/api/admin_login.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));

if($data && isset($data->username) && isset($data->password)) {
    $username = $data->username;
    $password = $data->password;

    try {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            
            echo json_encode(array(
                "statut" => "succes",
                "message" => "Connexion réussie !",
                "user" => $admin['username']
            ));
        } else {
            http_response_code(401);
            echo json_encode(array("statut" => "erreur", "message" => "Identifiants incorrects."));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("statut" => "erreur", "message" => "Erreur serveur."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("statut" => "erreur", "message" => "Données incomplètes."));
}
