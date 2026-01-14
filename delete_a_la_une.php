<?php
require_once 'connexionBdd.php'; // Fichier de connexion à $bdd (PDO)

header('Content-Type: application/json; charset=utf-8');

// Vérifie que la requête est bien en POST et que 'id' est présent
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id_article = intval($_POST['id']); // Conversion en entier pour sécurité

    try {
        // ✅ Correction de la requête SQL : il manquait "FROM"
        $stmt = $bdd->prepare("DELETE FROM alaune WHERE id = :id");
        $stmt->bindParam(':id', $id_article, PDO::PARAM_INT);
        $stmt->execute();

        // Vérifie si un enregistrement a été supprimé
        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Article supprimé avec succès.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Aucun Article trouvé avec cet ID.'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur serveur : ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Requête invalide ou ID manquant.'
    ]);
}
?>
