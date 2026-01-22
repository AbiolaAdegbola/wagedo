    <?php
    session_start();
    header('Content-Type: application/json');
    include 'connexionBdd.php';

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'email/vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if (isset($_POST['submitFaireDon'])) {

        var_dump($_POST['submitFaireDon']);
        $nom = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $pays = htmlspecialchars($_POST['pays']);
        $phone = htmlspecialchars($_POST['phone']);
        $mode_paiement = htmlspecialchars($_POST['mode_paiement']);

        $ins = $bdd->prepare('INSERT INTO donateur(nom, email, pays, telephone, mode_paiement, date_don) VALUES(:nom, :email, :pays, :telephone, :mode_paiement, NOW())');


        $ins->bindParam(':nom', $nom);
        $ins->bindParam(':email', $email);
        $ins->bindParam(':telephone', $phone);
        $ins->bindParam(':pays', $pays);
        $ins->bindParam(':mode_paiement', $mode_paiement);
        $ins->execute();

        echo 'Nous allons vous confirmé la reception du DON dans quelqu\'instant; Merci de patienter!';

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail89.lwspanel.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contact@wagedo-h2.org';                     //SMTP username
            $mail->Password   = 'Contact@2025';                              //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('contact@wagedo-h2.org', 'WAGEDO');
            $mail->addAddress('contact@wagedo-h2.org', "");
            // $mail->AddCC('appessika.koffi@wagedo-h2.org', ' '); 
            // $mail->addAddress('abiole68@gmail.com', ' ');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // if (isset($email)) {
            //   $mail->addReplyTo($email, strtoupper($nom));
            // }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'NOUVEAU DONATEUR';
            $mail->Body    = 'Hello WAGEDO, <br><br>Vous avez un nouveau donateur ' . $nom . '<br><br><a href="https://wagedo-h2.org/dashboard.php">Voir le donateur</a>';
            // Set UTF-8 encoding
            $mail->CharSet = 'UTF-8';
            $mail->send();
            // echo 'Message envoyé avec succès';

        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    // Nous rejoindre
    if (isset($_POST['submitRejoindreWagedo'])) {

        $nom = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $pays = htmlspecialchars($_POST['pays']);
        $phone = htmlspecialchars($_POST['phone']);
        $ville = htmlspecialchars($_POST['ville']);
        $profession = htmlspecialchars($_POST['profession']);
        $raison = htmlspecialchars($_POST['raison']);
        $message = htmlspecialchars($_POST['message']);

        $ins = $bdd->prepare('INSERT INTO nous_rejoindre(nom, email, telephone, profession, ville,  pays, raison, message, createdAt) VALUES(:nom, :email, :telephone, :profession, :ville, :pays, :raison, :message, NOW())');


        $ins->bindParam(':nom', $nom);
        $ins->bindParam(':email', $email);
        $ins->bindParam(':telephone', $phone);
        $ins->bindParam(':pays', $pays);
        $ins->bindParam(':ville', $ville);
        $ins->bindParam(':profession', $profession);
        $ins->bindParam(':raison', $raison);
        $ins->bindParam(':message', $message);
        $ins->execute();

        echo 'Votre demande a été bien envoyé. Nous allons contacter dans les plus brefs delai!';

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail89.lwspanel.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contact@wagedo-h2.org';                     //SMTP username
            $mail->Password   = 'Contact@2025';                              //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('contact@wagedo-h2.org', 'WAGEDO');
            $mail->addAddress('contact@wagedo-h2.org', "");
            // $mail->AddCC('appessika.koffi@wagedo-h2.org', ' '); 
            // $mail->addAddress('abiole68@gmail.com', ' ');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // if (isset($email)) {
            //   $mail->addReplyTo($email, strtoupper($nom));
            // }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'NOUVELLE DEMANDE DE MEMBRE';
            $mail->Body    = 'Hello WAGEDO, <br><br>Vous avez une nouvelle demande de collaboration de ' . $nom . ' sur votre site web <br><br><a href="https://wagedo-h2.org/dashboard.php">Voir la demande</a>';
            // Set UTF-8 encoding
            $mail->CharSet = 'UTF-8';
            $mail->send();
            // echo 'Message envoyé avec succès';

        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    // Demande de partenariat
    if (isset($_POST['demandePartenariat'])) {

        $nom = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $pays = htmlspecialchars($_POST['pays']);
        $phone = htmlspecialchars($_POST['phone']);
        $ville = htmlspecialchars($_POST['ville']);
        $type_partenariat = htmlspecialchars($_POST['type_partenariat']);
        $raison = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['comment']);

        if ($type_partenariat === "autre") {
            $type_partenariat = htmlspecialchars($_POST['autrePartenariatDiv']);
        }

        $ins = $bdd->prepare('INSERT INTO partenariat(nom, email, telephone, pays, ville, partenariat, raison, descriptionPartenariat, createdAt) VALUES(:nom, :email, :telephone, :pays, :ville, :partenariat, :raison, :descriptionPartenariat, NOW())');

        $ins->bindParam(':nom', $nom);
        $ins->bindParam(':email', $email);
        $ins->bindParam(':telephone', $phone);
        $ins->bindParam(':pays', $pays);
        $ins->bindParam(':ville', $ville);
        $ins->bindParam(':partenariat', $type_partenariat);
        $ins->bindParam(':raison', $raison);
        $ins->bindParam(':descriptionPartenariat', $message);
        $ins->execute();

        echo 'Votre demande a été bien envoyé. Nous allons contacter dans les plus brefs delai!';

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail89.lwspanel.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contact@wagedo-h2.org';                     //SMTP username
            $mail->Password   = 'Contact@2025';                              //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('contact@wagedo-h2.org', 'WAGEDO');
            $mail->addAddress('contact@wagedo-h2.org', "");
            // $mail->AddCC('appessika.koffi@wagedo-h2.org', ' '); 
            // $mail->addAddress('abiole68@gmail.com', ' ');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // if (isset($email)) {
            //   $mail->addReplyTo($email, strtoupper($nom));
            // }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'NOUVELLE DEMANDE DE PARTENARIAT';
            $mail->Body    = 'Hello WAGEDO, <br><br>Vous avez une nouvelle demande de partenariat de ' . $nom . ' dont l\'adresse mail ' . $email . ' et le numéro de téléphone ' . $phone . ' <br><br> <a href="https://wagedo-h2.org/dashboard.php">Voir la demande</a>';
            // Set UTF-8 encoding
            $mail->CharSet = 'UTF-8';
            $mail->send();
            // echo 'Message envoyé avec succès';

        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    //connexion page administration
    if (isset($_POST['envoyerFormConnexion'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        $mdp = trim(htmlspecialchars($_POST['mdp']));

        try {
            $stmt = $bdd->prepare("SELECT * FROM connexion WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                echo json_encode(['success' => false, 'message' => "Adresse e-mail non trouvée."]);
                exit;
            }

            if ($result['mdp'] === $mdp) { // 🔒 (Remplace par password_verify si hashé)
                $_SESSION['admin'] = $result['nom'];
                echo json_encode(['success' => true, 'redirect' => 'dashboard.php']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => "Mot de passe incorrect."]);
                exit;
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => "Erreur serveur : " . $e->getMessage()]);
            exit;
        }
    }


    // Ajouter actualites
    if (isset($_POST['submitFormNewActualite'])) {
        $titre = trim(htmlspecialchars($_POST['title'] ?? ''));
        $auteur = trim(htmlspecialchars($_POST['auteur'] ?? ''));
        $categorie = trim(htmlspecialchars($_POST['categorie'] ?? ''));
        $contenu = $_POST['contenu'] ?? '';
        $nameTable = trim(htmlspecialchars($_POST['submitFormNewActualite'] ?? ''));

        // if ($categorie === "Autres") {
        //     $categorie = trim(htmlspecialchars($_POST['autre_categorie'] ?? ''));
        // }

        $uploadDir = __DIR__ . '/assets/img/blog/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imagePaths = [];

        // ✅ Gestion multi-fichiers
        if (!empty($_FILES['images']['name'][0])) {
            // Uniformiser le tableau des fichiers
            $files = [];
            foreach ($_FILES['images'] as $key => $values) {
                foreach ((array)$values as $i => $value) {
                    $files[$i][$key] = $value;
                }
            }

            // ✅ Extensions autorisées + nouveaux formats
            $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg', 'avif', 'heic'];

            foreach ($files as $file) {
                if ($file['error'] !== UPLOAD_ERR_OK) continue;

                $fileName = basename($file['name']);
                $fileTmp = $file['tmp_name'];
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // Vérification du type MIME par sécurité
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $fileTmp);
                finfo_close($finfo);

                $allowedMime = [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                    'image/webp',
                    'image/bmp',
                    'image/svg+xml',
                    'image/avif',
                    'image/heic'
                ];

                if (in_array($fileExt, $allowedExt) && in_array($mime, $allowedMime)) {
                    // Nom unique + nettoyage du nom original
                    $cleanName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($fileName, PATHINFO_FILENAME));
                    $newFileName = uniqid($cleanName . '_', true) . '.' . $fileExt;
                    $targetFile = $uploadDir . $newFileName;

                    // Déplacement du fichier
                    if (move_uploaded_file($fileTmp, $targetFile)) {
                        // Vérifie si l’image est valide (évite scripts déguisés)
                        if (@getimagesize($targetFile)) {
                            $imagePaths[] = '/assets/img/blog/' . $newFileName;
                        } else {
                            unlink($targetFile);
                        }
                    }
                }
            }
        }

        $imagesJSON = json_encode($imagePaths, JSON_UNESCAPED_SLASHES);

        if ($nameTable === "projets") {
            $etat = trim(htmlspecialchars($_POST['etat'] ?? ''));

            $ins = $bdd->prepare('INSERT INTO projets (titre, images, auteur, categorie, contenu, etat, createdAt) 
                          VALUES (:titre, :images, :auteur, :categorie, :contenu, :etat, NOW())');
            $ins->execute([
                ':titre' => $titre,
                ':images' => $imagesJSON,
                ':auteur' => $auteur,
                ':categorie' => $categorie,
                ':contenu' => $contenu,
                ':etat' => $etat
            ]);
            echo '<div style="color: green;">✅ Votre projet a été publié avec succès.</div>';
        } else {
            $ins = $bdd->prepare('INSERT INTO actualite (titre, images, auteur, categorie, contenu, createdAt) 
                          VALUES (:titre, :images, :auteur, :categorie, :contenu, NOW())');
            $ins->execute([
                ':titre' => $titre,
                ':images' => $imagesJSON,
                ':auteur' => $auteur,
                ':categorie' => $categorie,
                ':contenu' => $contenu
            ]);
            echo '<div style="color: green;">✅ Votre article a été publié avec succès.</div>';
        }
    }

    // Message visiteur
    if (isset($_POST['submitFormMessageVisiteur'])) {

        $nom = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $titre = htmlspecialchars($_POST['titre']);
        $contenu = htmlspecialchars($_POST['contenu']);

        $ins = $bdd->prepare('INSERT INTO message_visiteur(nom, email, titre, contenu, createdAt) VALUES(:nom, :email, :titre, :contenu, NOW())');

        $ins->bindParam(':nom', $nom);
        $ins->bindParam(':email', $email);
        $ins->bindParam(':titre', $titre);
        $ins->bindParam(':contenu', $contenu);
        $ins->execute();

        echo 'Votre message a été envoyé avec succès.';
    }

    // Opportunity
    if (isset($_POST['submitFormNewOpportunity'])) {

        $auteur = htmlspecialchars($_POST['auteur']);
        $titre = htmlspecialchars($_POST['titre']);
        $contenu = $_POST['contenu'] ?? '';

        $ins = $bdd->prepare('INSERT INTO opportunity(titre, auteur, contenu, createdAt) VALUES(:titre, :auteur, :contenu, NOW())');

        $ins->bindParam(':auteur', $auteur);
        $ins->bindParam(':titre', $titre);
        $ins->bindParam(':contenu', $contenu);
        $ins->execute();

        echo 'Nouvelle opportunité ajoutée avec succès.';
    }

    // A LA UNE
    if (isset($_POST['submitFormNewALaUne'])) {

        $auteur = htmlspecialchars($_POST['auteur']);
        $titre = htmlspecialchars($_POST['titre']);

        $ins = $bdd->prepare('INSERT INTO alaune(titre, auteur, createdAt) VALUES(:titre, :auteur, NOW())');

        $ins->bindParam(':auteur', $auteur);
        $ins->bindParam(':titre', $titre);
        $ins->execute();

        echo 'Nouvelle a la une ajoutée avec succès.';
    }

    // newsletters
    if (isset($_POST['submitFormNewsletter'])) {

        $email = htmlspecialchars($_POST['email']);
        // var_dump($email);
        $ins = $bdd->prepare('INSERT INTO newsletters(email, createdAt) VALUES(:email, NOW())');

        $ins->bindParam(':email', $email);
        $ins->execute();

        echo 'Votre inscription au newsletters de WAGEDO a été effectué avec succès.';

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail89.lwspanel.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contact@wagedo-h2.org';                     //SMTP username
            $mail->Password   = 'Contact@2025';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // //Recipients
            $mail->setFrom('contact@wagedo-h2.org', 'WAGEDO');
            $mail->addAddress($email, ' ');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'NEWSLETTER WAGEDO';
            $mail->Body    = "
    Bonjour,
<br><br>
Nous vous remercions chaleureusement de vous être inscrit à notre newsletter et nous vous souhaitons la bienvenue chez WAGEDO ! Nous sommes ravis de vous compter parmi nos abonnés.<br><br>
Envie d'en savoir plus sur WAGEDO ? Visitez notre page <a href='https://wagedo-h2.org/'>À propos</a>  pour découvrir notre mission, notre équipe et notre engagement.

 <br><br>
Nous serions ravis d'échanger avec vous. Si vous avez des questions ou des suggestions, n'hésitez pas à nous contacter :
<br><br>
Email : <a href='mailto:contact@wagedo-h2.org'>contact@wagedo-h2.org</a>
Merci encore pour votre inscription et votre confiance. Nous sommes impatients de partager avec vous les dernières nouvelles.

 <br><br>

Cordialement,
<br>
L'équipe WAGEDO";


            // Set UTF-8 encoding
            $mail->CharSet = 'UTF-8';

            $mail->send();
            // echo 'Message envoyé avec succès';

        } catch (Exception $e) {

            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    // ✅ Ajouter une nouvelle ressource (images + documents)
    // if (isset($_POST['submitFormNewRessource'])) {
    //     // var_dump($_POST['submitFormNewRessource']);
    //     $titre = trim(htmlspecialchars($_POST['title'] ?? ''));
    //     $auteur = trim(htmlspecialchars($_POST['auteur'] ?? ''));
    //     $categorie = trim(htmlspecialchars($_POST['categorie'] ?? ''));
    //     $contenu = $_POST['contenu'] ?? '';
    //     $nameTable = trim(htmlspecialchars($_POST['submitFormNewRessource'] ?? ''));

    //     $uploadDir = __DIR__ . '/assets/img/ressources/';
    //     if (!is_dir($uploadDir)) {
    //         mkdir($uploadDir, 0777, true);
    //     }

    //     $filePaths = [];

    //     // ✅ Gestion multi-fichiers
    //     if (!empty($_FILES['fichiers']['name'][0])) {
    //         $files = [];
    //         foreach ($_FILES['fichiers'] as $key => $values) {
    //             foreach ((array)$values as $i => $value) {
    //                 $files[$i][$key] = $value;
    //             }
    //         }

    //         // ✅ Extensions autorisées (images + documents)
    //         $allowedExt = [
    //             // Images
    //             'jpg',
    //             'jpeg',
    //             'png',
    //             'gif',
    //             'webp',
    //             'bmp',
    //             'svg',
    //             'avif',
    //             'heic',
    //             // Documents
    //             'pdf',
    //             'doc',
    //             'docx',
    //             'xls',
    //             'xlsx',
    //             'txt'
    //         ];

    //         // ✅ Types MIME autorisés
    //         $allowedMime = [
    //             // Images
    //             'image/jpeg',
    //             'image/png',
    //             'image/gif',
    //             'image/webp',
    //             'image/bmp',
    //             'image/svg+xml',
    //             'image/avif',
    //             'image/heic',
    //             // PDF
    //             'application/pdf',
    //             // Word
    //             'application/msword',
    //             'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    //             // Excel
    //             'application/vnd.ms-excel',
    //             'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    //             // Texte
    //             'text/plain'
    //         ];

    //         foreach ($files as $file) {
    //             if ($file['error'] !== UPLOAD_ERR_OK) continue;

    //             $fileName = basename($file['name']);
    //             $fileTmp = $file['tmp_name'];
    //             $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    //             $finfo = finfo_open(FILEINFO_MIME_TYPE);
    //             $mime = finfo_file($finfo, $fileTmp);
    //             finfo_close($finfo);

    //             if (in_array($fileExt, $allowedExt) && in_array($mime, $allowedMime)) {
    //                 // ✅ Nom unique et sécurisé
    //                 $cleanName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($fileName, PATHINFO_FILENAME));
    //                 $newFileName = uniqid($cleanName . '_', true) . '.' . $fileExt;
    //                 $targetFile = $uploadDir . $newFileName;

    //                 if (move_uploaded_file($fileTmp, $targetFile)) {
    //                     // Pour les images, vérifier qu'elles sont valides
    //                     if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg', 'avif', 'heic'])) {
    //                         if (!@getimagesize($targetFile)) {
    //                             unlink($targetFile);
    //                             continue;
    //                         }
    //                     }

    //                     // ✅ Stocker le chemin relatif
    //                     $filePaths[] = '/assets/img/ressources/' . $newFileName;
    //                 }
    //             }
    //         }
    //     }

    //     $filesJSON = json_encode($filePaths, JSON_UNESCAPED_SLASHES);

    //     // ✅ Insertion en base de données
    //     $ins = $bdd->prepare('INSERT INTO ressource (titre, images, auteur, categorie, contenu, createdAt) 
    //                       VALUES (:titre, :images, :auteur, :categorie, :contenu, NOW())');
    //     $ins->execute([
    //         ':titre' => $titre,
    //         ':images' => $filesJSON,
    //         ':auteur' => $auteur,
    //         ':categorie' => $categorie,
    //         ':contenu' => $contenu
    //     ]);

    //     echo '<div style="color: green;">✅ Votre ressource a été publiée avec succès.</div>';
    // }

// ✅ Ajouter une nouvelle ressource (images + documents)
if (isset($_POST['submitFormNewRessource'])) {

    $titre = trim(htmlspecialchars($_POST['title'] ?? ''));
    $auteur = trim(htmlspecialchars($_POST['auteur'] ?? ''));
    $categorie = trim(htmlspecialchars($_POST['categorie'] ?? ''));
    $contenu = $_POST['contenu'] ?? '';
    $nameTable = trim(htmlspecialchars($_POST['submitFormNewRessource'] ?? ''));

    // ✅ Chemin absolu du dossier d’upload
    $uploadDir = __DIR__ . '/assets/img/ressources/';

    // Vérifier ou créer le dossier
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("❌ Impossible de créer le dossier : $uploadDir");
        }
    }

    $filePaths = [];

    // ✅ Gestion multi-fichiers
    if (!empty($_FILES['fichiers']['name'][0])) {
        $files = [];
        foreach ($_FILES['fichiers'] as $key => $values) {
            foreach ((array)$values as $i => $value) {
                $files[$i][$key] = $value;
            }
        }

        // ✅ Extensions autorisées
        $allowedExt = [
            'jpg','jpeg','png','gif','webp','bmp','svg','avif','heic',
            'pdf','doc','docx','xls','xlsx','txt'
        ];

        // ✅ Types MIME autorisés
        $allowedMime = [
            'image/jpeg','image/png','image/gif','image/webp','image/bmp','image/svg+xml','image/avif','image/heic',
            'application/pdf',
            'application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain'
        ];

        foreach ($files as $file) {
            if ($file['error'] !== UPLOAD_ERR_OK) continue;

            $fileName = basename($file['name']);
            $fileTmp = $file['tmp_name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Vérification du type MIME
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $fileTmp);
            finfo_close($finfo);

            if (in_array($fileExt, $allowedExt) && in_array($mime, $allowedMime)) {
                $cleanName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($fileName, PATHINFO_FILENAME));
                $newFileName = uniqid($cleanName . '_', true) . '.' . $fileExt;
                $targetFile = $uploadDir . $newFileName;

                // ✅ Sauvegarde du fichier
                if (move_uploaded_file($fileTmp, $targetFile)) {

                    // Vérifier les images valides
                    if (in_array($fileExt, ['jpg','jpeg','png','gif','webp','bmp','svg','avif','heic'])) {
                        if (!@getimagesize($targetFile)) {
                            unlink($targetFile);
                            continue;
                        }
                    }

                    // ✅ Chemin relatif (pour affichage web)
                    $filePaths[] = 'assets/img/ressources/' . $newFileName;
                } else {
                    echo "<div style='color:red;'>❌ Erreur lors du déplacement du fichier : $fileName</div>";
                }
            } else {
                echo "<div style='color:red;'>❌ Fichier non autorisé : $fileName ($mime)</div>";
            }
        }
    }

    // ✅ Encodage JSON des fichiers
    $filesJSON = json_encode($filePaths, JSON_UNESCAPED_SLASHES);

    // ✅ Insertion dans la base de données
    $ins = $bdd->prepare('INSERT INTO ressource (titre, images, auteur, categorie, contenu, createdAt) 
                          VALUES (:titre, :images, :auteur, :categorie, :contenu, NOW())');
    $success = $ins->execute([
        ':titre' => $titre,
        ':images' => $filesJSON,
        ':auteur' => $auteur,
        ':categorie' => $categorie,
        ':contenu' => $contenu
    ]);

    if ($success) {
        echo '<div style="color: green;">✅ Votre ressource a été publiée avec succès.</div>';
    } else {
        echo '<div style="color: red;">❌ Erreur lors de l’enregistrement en base de données.</div>';
    }
}



    if (isset($_POST['etat_projet'])) {
        $id = htmlspecialchars($_POST['id']);
        $etat = htmlspecialchars($_POST['etat_projet']);

        $update = $bdd->prepare('UPDATE projets SET etat=:etat WHERE id =:id');
        $update->bindParam(':etat', $etat);
        $update->bindParam(':id', $id);
        $update->execute();
    }

    ?>