<?php
require_once 'connexionBdd.php'; // Connexion à $bdd (PDO)

header('Content-Type: application/json; charset=utf-8');

if ($_GET["id"]) {
    $id_article = htmlspecialchars($_GET["id"]);
    try {
    $stmt = $bdd->prepare("SELECT id, titre, auteur, contenu, createdAt FROM opportunity WHERE id=:id");
    $stmt->bindParam(':id', $id_article);
    $stmt->execute();

    $actualites = $stmt->fetch();


    echo json_encode(['success' => true, 'data' => $actualites]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
}
}

