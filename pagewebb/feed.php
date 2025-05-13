<?php
// Paramètres de connexion
$host = "localhost";
$user = "root"; // Par défaut avec XAMPP
$password = "";
$dbname = "onepiece_app";

// Connexion à la base
$conn = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les données de la requête
$data = json_decode(file_get_contents("php://input"), true);
$username = $conn->real_escape_string($data['username']);
$email = $conn->real_escape_string($data['email']);
$comment = $conn->real_escape_string($data['comment']);

// Insérer les données
$sql = "INSERT INTO feedback (username, email, comment) VALUES ('$username', '$email', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Commentaire enregistré avec succès !"]);
} else {
    echo json_encode(["error" => "Erreur : " . $conn->error]);
}

$conn->close();
?>
