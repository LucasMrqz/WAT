<?php
require_once './co_bdd.php';

// Ajouter des en-têtes CORS
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Lire les données JSON envoyées
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($data['numTicket'])) {
    $numTicket = $data['numTicket'];

    try {
        // Préparer et exécuter la requête de suppression
        $query = $lien->prepare("DELETE FROM ticket WHERE numTicket = :numTicket");
        $query->bindParam(':numTicket', $numTicket, PDO::PARAM_INT);
        $success = $query->execute();

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete ticket']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>