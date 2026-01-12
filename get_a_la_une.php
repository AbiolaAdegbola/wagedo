<?php
require_once 'connexionBdd.php'; // Connexion à $bdd (PDO)

header('Content-Type: application/json; charset=utf-8');

try {
    // Requête
    $stmt = $bdd->prepare("SELECT titre FROM alaune ORDER BY createdAt DESC");
    $stmt->execute();

    // Récupération directe des titres sous forme de tableau simple
    $titres = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode([
        'success' => true,
        'data' => $titres
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur : ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
