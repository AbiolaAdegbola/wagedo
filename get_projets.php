<?php
require_once 'connexionBdd.php'; // Connexion à $bdd (PDO)
header('Content-Type: application/json; charset=utf-8');

// ✅ Utilisation de $_GET en toute sécurité
$etat_projet = $_GET['etat'] ?? null;

if (!$etat_projet) {
    echo json_encode([
        'success' => false,
        'message' => 'Paramètre "etat" manquant ou vide'
    ]);
    exit;
}

try {
    // ✅ Nettoyage de l’entrée
    $etat_projet = trim(htmlspecialchars($etat_projet));

    $etat= ($etat_projet === 'Nouveau') ? 0 : 1;

    // ✅ Préparation et exécution sécurisée de la requête
    $stmt = $bdd->prepare("
        SELECT id, titre, images, auteur, categorie, contenu, etat, createdAt 
        FROM projets 
        WHERE etat = :etat 
        ORDER BY createdAt DESC
    ");
    $stmt->execute([':etat' => $etat]);

    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ✅ Décodage JSON propre des images
    foreach ($projets as &$projet) {
        $projet['images'] = json_decode($projet['images'], true) ?? [];
    }

    // ✅ Réponse claire et structurée
    echo json_encode([
        'success' => true,
        'count' => count($projets),
        'etat' => $etat_projet,
        'data' => $projets
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur base de données : ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur interne : ' . $e->getMessage()
    ]);
}
