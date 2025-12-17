<?php
require_once 'connexionBdd.php'; // Connexion à $bdd (PDO)

header('Content-Type: application/json; charset=utf-8');

try {
    $categorie = htmlspecialchars($_GET["categorie"]);

    // --- 1️⃣ Récupération depuis actualite ---
    $stmt1 = $bdd->prepare("SELECT id, titre, images, auteur, categorie, contenu, createdAt 
                            FROM actualite 
                            WHERE categorie = :categorie 
                            ORDER BY createdAt DESC");
    $stmt1->bindParam(':categorie', $categorie);
    $stmt1->execute();
    $actualites = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // Ajouter une variable item = "actualite"
    foreach ($actualites as &$actu) {
        $actu['images'] = json_decode($actu['images'], true);
        $actu['item'] = 'actualite';
    }

    // --- 2️⃣ Récupération depuis projets ---
    $stmt2 = $bdd->prepare("SELECT id, titre, images, auteur, categorie, contenu, createdAt 
                            FROM projets 
                            WHERE categorie = :categorie 
                            ORDER BY createdAt DESC");
    $stmt2->bindParam(':categorie', $categorie);
    $stmt2->execute();
    $projets = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Ajouter une variable item = "projet"
    foreach ($projets as &$projet) {
        $projet['images'] = json_decode($projet['images'], true);
        $projet['item'] = 'projet';
    }

    // --- 3️⃣ Fusionner les deux listes ---
    $resultats = array_merge($actualites, $projets);

    // --- 4️⃣ Réordonner par date de création (plus récent d'abord) ---
    usort($resultats, function($a, $b) {
        return strtotime($b['createdAt']) - strtotime($a['createdAt']);
    });

    echo json_encode(['success' => true, 'data' => $resultats], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
}
