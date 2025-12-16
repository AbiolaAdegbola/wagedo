<?php
require_once 'connexionBdd.php'; // Connexion à $bdd (PDO)

header('Content-Type: application/json; charset=utf-8');

try {
    $categorie = htmlspecialchars($_GET["categorie"]);
    $stmt = $bdd->prepare("SELECT id, titre, images, auteur, categorie, contenu, createdAt FROM actualite WHERE categorie=:categorie ORDER BY createdAt DESC");
    $stmt->bindParam(':categorie', $categorie);
    $stmt->execute();

    // $actualites = $stmt->fetch();
    $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Décoder le JSON des images
    foreach ($actualites as &$actu) {
        $actu['images'] = json_decode($actu['images'], true);
    }

    echo json_encode(['success' => true, 'data' => $actualites]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
}
