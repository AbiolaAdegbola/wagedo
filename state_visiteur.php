<?php
include 'connexionBdd.php';

try {
    // --------- Informations visiteur ---------
    $ip = $_SERVER['REMOTE_ADDR'];
    $jour = date('Y-m-d');  // format YYYY-MM-DD
    $jourActuel = (int)date('j'); // jour du mois
    $dateComplete = date("d/m/Y");

    // --------- Vérifier si l'IP a déjà été comptée aujourd'hui ---------
    $stmt = $bdd->prepare("SELECT COUNT(*) FROM visites_jour WHERE ip = :ip AND jour = :jour");
    $stmt->execute(['ip' => $ip, 'jour' => $jour]);
    $dejaCompte = $stmt->fetchColumn() > 0;

    if (!$dejaCompte) {
        // --------- Enregistrer la visite ---------
        $stmt = $bdd->prepare("INSERT INTO visites_jour (ip, jour) VALUES (:ip, :jour)");
        $stmt->execute(['ip' => $ip, 'jour' => $jour]);

        // --------- Récupérer les données globales ---------
        $stmt = $bdd->query("SELECT * FROM visiteur LIMIT 1");
        $visiteurData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$visiteurData) exit("Erreur : données de visiteurs introuvables.");

        $count = (int)$visiteurData['count'];
        $nombre = !empty($visiteurData['nombre']) ? explode(', ', $visiteurData['nombre']) : [];
        $mois = !empty($visiteurData['mois']) ? explode(', ', $visiteurData['mois']) : [];
        $etat = (int)$visiteurData['etat'];

        // --------- Logique compteur ---------
        $dernierNombre = end($nombre) ?: 0; // dernier jour du mois
        if ($jourActuel != 5) {
            // Simple incrément du compteur
            $dernierNombre++;
            $count++;
            $etat = 1;
        } else {
            // Jour spécial (5ème du mois)
            if ($etat === 1) {
                $mois[] = $dateComplete;
                $nombre[] = $dernierNombre;
                $count = 1; // recommencer le compteur
                $dernierNombre = 1;
                $etat = 0;
            } else {
                $dernierNombre++;
                $count++;
            }
        }

        $nombre[count($nombre) - 1] = $dernierNombre;

        // --------- Mise à jour de la table visiteur ---------
        $req = $bdd->prepare("UPDATE visiteur SET count = :count, nombre = :nombre, mois = :mois, etat = :etat");
        $req->execute([
            ':count' => $count,
            ':nombre' => implode(', ', $nombre),
            ':mois' => implode(', ', $mois),
            ':etat' => $etat
        ]);
    }

    echo json_encode(['success' => true, 'message' => 'State mis à jour avec succès']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erreur serveur: ' . $e->getMessage()]);
}
