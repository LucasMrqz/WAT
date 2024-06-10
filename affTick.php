<?php
require_once './co_bdd.php';

// Ajouter des en-têtes CORS
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

try {
    $query = $lien->prepare("SELECT * FROM ticket");
    $query->execute();
    $tickets = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tickets);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
}
?>