    <?php 
    session_start();
    include 'connexionBdd.php';


    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
    // require 'excel/vendor/autoload.php';


    //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        if (isset($_POST['devisForage'])) {


        $devisForage = $_POST['devisForage'];
        $devisForageTable = explode('&', $devisForage);
        
        if(isset($_POST['campagneForage'])){
            $typeDevis = "campagneForage";
        }
        else{
            $typeDevis = "forage";
        }
        

        $typeForage = explode('=', $devisForageTable[0]);
        $typeForagePlusChateau = explode('=', $devisForageTable[1]);
        $typeForageUsage = explode('=', $devisForageTable[2]);
        $nom = explode('=', $devisForageTable[3]);
        $phone = explode('=', $devisForageTable[4]);
        $email = explode('=', $devisForageTable[5]);
        $pays = explode('=', $devisForageTable[6]);
        $ville = explode('=', $devisForageTable[7]);
        $budget = explode('=', $devisForageTable[8]);
        $decouverte = explode('=', $devisForageTable[9]);
        $message = explode('=', $devisForageTable[10]);

        $informationDevis = $typeForage[1].'@]@'.$typeForagePlusChateau[1].'@]@'.$typeForageUsage[1];


      $ins = $bdd->prepare('INSERT INTO devis(nom, telephone, email, pays, ville, budget, decouvert, message, typeDevis, informationDevis, date_devis) VALUES(:nom, :telephone, :email, :pays, :ville, :budget, :decouvert, :message, :typeDevis, :informationDevis, NOW())');

      $ins->bindParam(':nom', $nom[1]);
      $ins->bindParam(':email', $email[1]);
      $ins->bindParam(':telephone', $phone[1]);
      $ins->bindParam(':pays', $pays[1]);
      $ins->bindParam(':ville', $ville[1]);
      $ins->bindParam(':budget', $budget[1]);
      $ins->bindParam(':decouvert', $decouverte[1]);
      $ins->bindParam(':message', $message[1]);
      $ins->bindParam(':informationDevis', $informationDevis);
      $ins->bindParam(':typeDevis', $typeDevis);
      $ins->execute();
      
      try{
        //   $url = 'https://hook.eu2.make.com/vas8nzpiopblwvoiw91gqjrrqt0998ml';
          
        $url = 'https://hook.eu2.make.com/vas8nzpiopblwvoiw91gqjrrqt0998ml?nom='.$nom[1].'&WHATSAPP='.$phone[1].'&e-mail='.$email[1];
        $response = file_get_contents($url);
        
        $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);

curl_close($ch);


      }catch(Exception $e){
          echo "erreur".$e;
      }


try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress('devis@greenagrovalley.org', ""); 
    $mail->AddCC('vente@agrovalley.odoo.com', '');
    // $mail->addAddress('abiole68@gmail.com', ' ');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'DEMANDE DE DEVIS FORAGE';
    $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br>Mon numéro de téléphone : '.$phone[1].' <br><br> Je veux le devis pour un forage : '.$typeForage[1].'<br><br><a href="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message envoyé avec succès';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
}


        }
        
        
if (isset($_POST['promoLaserSpray'])) {


        $promoLaserSpray = $_POST['promoLaserSpray'];
        $devisForageTable = explode('&', $promoLaserSpray);

        $typeDevis = "promoLaser";

        $nom = explode('=', $devisForageTable[0]);
        $phone = explode('=', $devisForageTable[1]);
        $email = explode('=', $devisForageTable[2]);
        $superficie = explode('=', $devisForageTable[3]);
        $longueur = explode('=', $devisForageTable[4]);
        $largeur = explode('=', $devisForageTable[5]);
        $distance = explode('=', $devisForageTable[6]);
        $pays = explode('=', $devisForageTable[7]);
        $ville = explode('=', $devisForageTable[8]);
        $budget = "";
        $decouverte = explode('=', $devisForageTable[9]);
        $message = explode('=', $devisForageTable[10]);

        $informationDevis = $superficie[1].'@]@'.$longueur[1].'@]@'.$largeur[1].'@]@ N/A @]@'.$distance[1];


     $ins = $bdd->prepare('INSERT INTO devis(nom, telephone, email, pays, ville, budget, decouvert, message, typeDevis, informationDevis, date_devis) VALUES(:nom, :telephone, :email, :pays, :ville, :budget, :decouvert, :message, :typeDevis, :informationDevis, NOW())');


      $ins->bindParam(':nom', $nom[1]);
      $ins->bindParam(':email', $email[1]);
      $ins->bindParam(':telephone', $phone[1]);
      $ins->bindParam(':pays', $pays[1]);
      $ins->bindParam(':ville', $ville[1]);
      $ins->bindParam(':budget', $budget);
      $ins->bindParam(':decouvert', $decouverte[1]);
      $ins->bindParam(':message', $message[1]);
      $ins->bindParam(':informationDevis', $informationDevis);
      $ins->bindParam(':typeDevis', $typeDevis);
      $ins->execute();


try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress('devis@greenagrovalley.org', ""); 
 
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'COMMANDE PROMO LASER SPRAY';
    $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br>Mon numéro de téléphone : '.$phone[1].' <br><br> J\'ai effectué ma commande pour la promo LASER SPRAY : <br><br><a href="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message envoyé avec succès';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
}

    }



 if (isset($_POST['devisLaser'])) {

    $devisLaser = $_POST['devisLaser'];
    $devisLaserTable = explode('&', $devisLaser);

        // var_dump($devisLaserTable);
    $typeDevis = "laserSpray";

    $typeLaserSurface = explode('=', $devisLaserTable[0]);
    $typeLaserSurfaceAutre = explode('=', $devisLaserTable[1]);

    $typeLaserSurfaceFinal = '';

    if ($typeLaserSurfaceAutre[1] !="") {
        $typeLaserSurfaceFinal = $typeLaserSurfaceAutre[1];
    } else {
        $typeLaserSurfaceFinal = $typeLaserSurface[1];
    }


    $typeLaseLongueur = explode('=', $devisLaserTable[2]);
    $typeLaserLargeur = explode('=', $devisLaserTable[3]);


    $typeLaserCotePointEau = explode('=', $devisLaserTable[4]);
    $typeLaserCotePointEauAutre = explode('=', $devisLaserTable[5]);

    $typeLaserCotePointEauFinal = '';

    if ($typeLaserCotePointEauAutre[1] != "") {
        $typeLaserCotePointEauFinal = $typeLaserCotePointEauAutre[1];
    } else {
        $typeLaserCotePointEauFinal = $typeLaserCotePointEau[1];
    }


    $typeLaserDistanceEauParcelle = explode('=', $devisLaserTable[6]);
    $typeLaserDistanceEauParcelleAutre = explode('=', $devisLaserTable[7]);

    $typeLaserDistanceEauParcelleFinal = '';

    if ($typeLaserDistanceEauParcelleAutre[1] != "") {
        $typeLaserDistanceEauParcelleFinal = $typeLaserDistanceEauParcelleAutre[1];
    } else {
        $typeLaserDistanceEauParcelleFinal = $typeLaserDistanceEauParcelle[1];
    }


    $nom = explode('=', $devisLaserTable[8]);
    $phone = explode('=', $devisLaserTable[9]);
    $email = explode('=', $devisLaserTable[10]);
    $pays = explode('=', $devisLaserTable[11]);
    $ville = explode('=', $devisLaserTable[12]);
    $budget = explode('=', $devisLaserTable[13]);
    $decouverte = explode('=', $devisLaserTable[14]);
    $message = explode('=', $devisLaserTable[15]);

    $informationDevis = $typeLaserSurfaceFinal.'@]@'.$typeLaseLongueur[1].'@]@'.$typeLaserLargeur[1].'@]@'.$typeLaserCotePointEauFinal.'@]@'.$typeLaserDistanceEauParcelleFinal;


 $ins = $bdd->prepare('INSERT INTO devis(nom, telephone, email, pays, ville, budget, decouvert, message, typeDevis, informationDevis, date_devis) VALUES(:nom, :telephone, :email, :pays, :ville, :budget, :decouvert, :message, :typeDevis, :informationDevis, NOW())');


  $ins->bindParam(':nom', $nom[1]);
  $ins->bindParam(':email', $email[1]);
  $ins->bindParam(':telephone', $phone[1]);
  $ins->bindParam(':pays', $pays[1]);
  $ins->bindParam(':ville', $ville[1]);
  $ins->bindParam(':budget', $budget[1]);
  $ins->bindParam(':decouvert', $decouverte[1]);
  $ins->bindParam(':message', $message[1]);
  $ins->bindParam(':informationDevis', $informationDevis);
  $ins->bindParam(':typeDevis', $typeDevis);
  $ins->execute();
  
      
             
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
     $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                      //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                              //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    // $mail->addAddress('abiole68@gmail.com', ' ');    
    $mail->addAddress('devis@greenagrovalley.org', "");  
    $mail->AddCC('vente@agrovalley.odoo.com', ' '); //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'DEMANDE DE DEVIS LASER SPRAY';
    $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br>Mon numéro de téléphone : '.$phone[1].' <br><br> Je veux le devis du système d\'irrigation LASER SPRAY : '.$typeForage[1].'<br><br><a href="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message envoyé avec succès';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
}

    }
        
if (isset($_POST['devisForagePlusLaserForm'])) {


        $devisForagePlusLaser = $_POST['devisForagePlusLaserForm'];
        $devisForagePlusLaserTable = explode('&', $devisForagePlusLaser);
        
        var_dump($devisForagePlusLaserTable);

        $typeDevis = "foragepluslaser";
        
        
        //variable laser
        $typeLaserSurface = explode('=', $devisForagePlusLaserTable[0]);
        $typeLaserSurfaceAutre = explode('=', $devisForagePlusLaserTable[1]);

        $typeLaserSurfaceFinal = '';

            if ($typeLaserSurfaceAutre[1] !="") {
                $typeLaserSurfaceFinal = $typeLaserSurfaceAutre[1];
            } else {
                $typeLaserSurfaceFinal = $typeLaserSurface[1];
            }
        

            $typeLaseLongueur = explode('=', $devisForagePlusLaserTable[2]);
            $typeLaserLargeur = explode('=', $devisForagePlusLaserTable[3]);


            $typeLaserCotePointEau = explode('=', $devisForagePlusLaserTable[4]);
            $typeLaserCotePointEauAutre = explode('=', $devisForagePlusLaserTable[5]);

            $typeLaserCotePointEauFinal = '';

            if ($typeLaserCotePointEauAutre[1] != "") {
                $typeLaserCotePointEauFinal = $typeLaserCotePointEauAutre[1];
            } else {
                $typeLaserCotePointEauFinal = $typeLaserCotePointEau[1];
            }


            $typeLaserDistanceEauParcelle = explode('=', $devisForagePlusLaserTable[6]);
            $typeLaserDistanceEauParcelleAutre = explode('=', $devisForagePlusLaserTable[7]);

            $typeLaserDistanceEauParcelleFinal = '';

            if ($typeLaserDistanceEauParcelleAutre[1] != "") {
                $typeLaserDistanceEauParcelleFinal = $typeLaserDistanceEauParcelleAutre[1];
            } else {
                $typeLaserDistanceEauParcelleFinal = $typeLaserDistanceEauParcelle[1];
            }
        
            $informationDevis = $typeLaserSurfaceFinal.'@]@'.$typeLaseLongueur[1].'@]@'.$typeLaserLargeur[1].'@]@'.$typeLaserCotePointEauFinal.'@]@'.$typeLaserDistanceEauParcelleFinal;
        
        //variable forage

        $typeForage = explode('=', $devisForagePlusLaserTable[8]);
        $typeForagePlusChateau = explode('=', $devisForagePlusLaserTable[9]);
        $typeForageUsage = explode('=', $devisForagePlusLaserTable[10]);
        $nom = explode('=', $devisForagePlusLaserTable[11]);
        $phone = explode('=', $devisForagePlusLaserTable[12]);
        $email = explode('=', $devisForagePlusLaserTable[13]);
        $pays = explode('=', $devisForagePlusLaserTable[14]);
        $ville = explode('=', $devisForagePlusLaserTable[15]);
        $budget = explode('=', $devisForagePlusLaserTable[16]);
        $decouverte = explode('=', $devisForagePlusLaserTable[17]);
        $message = explode('=', $devisForagePlusLaserTable[18]);

        $informationDevis = $informationDevis.'@]@'.$typeForage[1].'@]@'.$typeForagePlusChateau[1].'@]@'.$typeForageUsage[1];


     $ins = $bdd->prepare('INSERT INTO devis(nom, telephone, email, pays, ville, budget, decouvert, message, typeDevis, informationDevis, date_devis) VALUES(:nom, :telephone, :email, :pays, :ville, :budget, :decouvert, :message, :typeDevis, :informationDevis, NOW())');

      $ins->bindParam(':nom', $nom[1]);
      $ins->bindParam(':email', $email[1]);
      $ins->bindParam(':telephone', $phone[1]);
      $ins->bindParam(':pays', $pays[1]);
      $ins->bindParam(':ville', $ville[1]);
      $ins->bindParam(':budget', $budget[1]);
      $ins->bindParam(':decouvert', $decouverte[1]);
      $ins->bindParam(':message', $message[1]);
      $ins->bindParam(':informationDevis', $informationDevis);
      $ins->bindParam(':typeDevis', $typeDevis);
      $ins->execute();


try {
    // Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                                //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress('devis@greenagrovalley.org', "");  
      $mail->AddCC('vente@agrovalley.odoo.com', ' ');  
    // $mail->addAddress('abiole68@gmail.com', ' ');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }

    // Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'DEMANDE DE DEVIS FORAGE PLUS LASER SPRAY';
    $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br>Mon numéro de téléphone : '.$phone[1].' <br><br> Je veux le devis pour un forage plus l\'installation du système d\'irrigation laser spray : <br><br><a href="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message envoyé avec succès';

            } catch (Exception $e) {
            
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                
            }


    }


if (isset($_POST['commandeLaser'])) {
              $commandeLaser = $_POST['commandeLaser'];
        $commandeLaserTable = explode('&', $commandeLaser);
        // var_dump($commandeLaserTable);

        $typeDevis = "commande";

        $typeForage = explode('=', $commandeLaserTable[5]);
        // $typeForagePlusChateau = explode('=', $commandeLaserTable[1]);
        // $typeForageUsage = explode('=', $commandeLaserTable[2]);
        $nom = explode('=', $commandeLaserTable[0]);
        $phone = explode('=', $commandeLaserTable[1]);
        $email = explode('=', $commandeLaserTable[2]);
        $pays = explode('=', $commandeLaserTable[3]);
        $ville = explode('=', $commandeLaserTable[4]);
        $budget = explode('=', $commandeLaserTable[6]);
        $decouverte = explode('=', $commandeLaserTable[7]);
        $message = explode('=', $commandeLaserTable[8]);

        $informationDevis = $typeForage[1];


         $ins = $bdd->prepare('INSERT INTO devis(nom, telephone, email, pays, ville, budget, decouvert, message, typeDevis, informationDevis, date_devis) VALUES(:nom, :telephone, :email, :pays, :ville, :budget, :decouvert, :message, :typeDevis, :informationDevis, NOW())');


          $ins->bindParam(':nom', $nom[1]);
          $ins->bindParam(':email', $email[1]);
          $ins->bindParam(':telephone', $phone[1]);
          $ins->bindParam(':pays', $pays[1]);
          $ins->bindParam(':ville', $ville[1]);
          $ins->bindParam(':budget', $budget[1]);
          $ins->bindParam(':decouvert', $decouverte[1]);
          $ins->bindParam(':message', $message[1]);
          $ins->bindParam(':informationDevis', $informationDevis);
          $ins->bindParam(':typeDevis', $typeDevis);
          $ins->execute();
          
          
          
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress('devis@greenagrovalley.org', "");  
      $mail->AddCC('vente@agrovalley.odoo.com', ' '); 
    // $mail->addAddress('abiole68@gmail.com', ' ');      //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'COMMANDE D\'ARTICLE LASER SPRAY';
    $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br>Mon numéro de téléphone : '.$phone[1].' <br><br> Je veux l\'article laser spray : '.$typeForage[1].'<br><br><a href="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message envoyé avec succès';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
    }

          
}


if (isset($_POST['commandeForage'])) {

            $commandeForage = $_POST['commandeForage'];
        $commandeForageTable = explode('&', $commandeForage);
        // var_dump($commandeForageTable);

        $typeDevis = "forage";

        $typeForage = explode('=', $commandeForageTable[5]);
        // $typeForagePlusChateau = explode('=', $commandeForageTable[1]);
        // $typeForageUsage = explode('=', $commandeForageTable[2]);
        $nom = explode('=', $commandeForageTable[0]);
        $phone = explode('=', $commandeForageTable[1]);
        $email = explode('=', $commandeForageTable[2]);
        $pays = explode('=', $commandeForageTable[3]);
        $ville = explode('=', $commandeForageTable[4]);
        $budget = explode('=', $commandeForageTable[6]);
        $decouverte = explode('=', $commandeForageTable[7]);
        $message = explode('=', $commandeForageTable[8]);

        $informationDevis = $typeForage[1];


         $ins = $bdd->prepare('INSERT INTO devis(nom, telephone, email, pays, ville, budget, decouvert, message, typeDevis, informationDevis, date_devis) VALUES(:nom, :telephone, :email, :pays, :ville, :budget, :decouvert, :message, :typeDevis, :informationDevis, NOW())');


          $ins->bindParam(':nom', $nom[1]);
          $ins->bindParam(':email', $email[1]);
          $ins->bindParam(':telephone', $phone[1]);
          $ins->bindParam(':pays', $pays[1]);
          $ins->bindParam(':ville', $ville[1]);
          $ins->bindParam(':budget', $budget[1]);
          $ins->bindParam(':decouvert', $decouverte[1]);
          $ins->bindParam(':message', $message[1]);
          $ins->bindParam(':informationDevis', $informationDevis);
          $ins->bindParam(':typeDevis', $typeDevis);
          $ins->execute();
          
         
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
     $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress('devis@greenagrovalley.org', "");  
      $mail->AddCC('vente@agrovalley.odoo.com', ' ');  
    // $mail->addAddress('abiole68@gmail.com', ' ');    //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'DEMANDE DE DEVIS FORAGE';
    $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br>Mon numéro de téléphone : '.$phone[1].' <br><br> Je veux le devis pour un forage : '.$typeForage[1].'<br><br><a href="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message envoyé avec succès';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
}


        }
        
        
//boutique commander 
if (isset($_POST['commandeBoutiqueForm'])) {
        
        $commandeLaser = $_POST['commandeBoutiqueForm'];
        $commandeLaserTable = explode('&', $commandeLaser);
        // var_dump($commandeLaserTable);

        $typeDevis = "boutique";

        // $typeForage = explode('=', $commandeLaserTable[5]);
        // $typeForagePlusChateau = explode('=', $commandeLaserTable[1]);
        // $typeForageUsage = explode('=', $commandeLaserTable[2]);
        $nom = explode('=', $commandeLaserTable[0]);
        $phone = explode('=', $commandeLaserTable[1]);
        $email = explode('=', $commandeLaserTable[2]);
        $pays = explode('=', $commandeLaserTable[3]);
        $ville = explode('=', $commandeLaserTable[4]);
        $budget = " ";
        $decouverte = explode('=', $commandeLaserTable[6]);
        $articleCommander = explode('=', $commandeLaserTable[5]);
        $message = " ";

        $informationDevis = $articleCommander[1];


         $ins = $bdd->prepare('INSERT INTO devis(nom, telephone, email, pays, ville, budget, decouvert, message, typeDevis, informationDevis, date_devis) VALUES(:nom, :telephone, :email, :pays, :ville, :budget, :decouvert, :message, :typeDevis, :informationDevis, NOW())');


          $ins->bindParam(':nom', $nom[1]);
          $ins->bindParam(':email', $email[1]);
          $ins->bindParam(':telephone', $phone[1]);
          $ins->bindParam(':pays', $pays[1]);
          $ins->bindParam(':ville', $ville[1]);
          $ins->bindParam(':budget', $budget);
          $ins->bindParam(':decouvert', $decouverte[1]);
          $ins->bindParam(':message', $message);
          $ins->bindParam(':informationDevis', $informationDevis);
          $ins->bindParam(':typeDevis', $typeDevis);
          $ins->execute();
          
          
          
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress('devis@greenagrovalley.org', "");  
    //   $mail->AddCC('vente@agrovalley.odoo.com', ' '); 
    // $mail->addAddress('abiole68@gmail.com', ' ');      //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'COMMANDE D\'ARTICLE LASER SPRAY';
    $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br>Mon numéro de téléphone : '.$phone[1].' <br><br><a href="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message envoyé avec succès';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
    }

          
}
        
//Newsletter souscription
if (isset($_POST['newsletter'])) {

    $newsletter = htmlspecialchars($_POST['newsletter']);
// var_dump($newsletter);
    $newsletter = explode('&', $newsletter);
    $nom = explode('=', $newsletter[0]);
    $email = explode('=', $newsletter[1]);
    $profession = explode('=', $newsletter[2]);

    $ins = $bdd->prepare('INSERT INTO newsletter(nom, email, profession, dateEnregistrer) VALUES(:nom, :email, :profession, NOW())');
    $ins->bindParam(':email', $email[1]);
    $ins->bindParam(':nom', $nom[1]);
    $ins->bindParam(':profession', $profession[1]);
    $ins->execute();
    
    try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
     $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'abiola@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Abiola@2024';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress($email[1], ' ');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'INSCRIPTION NEWSLETTER GREEN AGRO VALLEY CI';
    $mail->Body    = "
    
    Bonjour,

 
<br><br>
Nous vous remercions chaleureusement de vous être inscrit à notre newsletter et nous vous souhaitons la bienvenue chez GREEN AGRO VALLEY CI ! Nous sommes ravis de vous compter parmi nos abonnés et de vous accompagner dans votre aventure vers des solutions de forage et d’irrigation innovantes.
<br>
Découvrez nos ressources populaires
Pour vous donner un aperçu de ce qui vous attend, voici quelques liens vers des pages et articles populaires sur notre site :
<br><br>
<a href='https://greenagrovalley.org/nos-forages.html'>Nos services de forage </a>: Découvrez nos solutions de forage efficaces et durables.<br>
<a href='https://greenagrovalley.org/about.html'>Technologie Laser Spray </a>: En savoir plus sur notre technologie innovante d'irrigation avec Laser Spray.<br>
<a href='https://greenagrovalley.org/'>Témoignages de clients</a> : Lisez les histoires de nos clients satisfaits et voyez comment nos services ont transformé leurs pratiques agricoles.
Optimisation de l'irrigation avec Laser Spray : Découvrez comment la technologie Laser Spray permet une irrigation précise et économe en eau, améliorant ainsi les rendements agricoles et la durabilité. Lire la suite

 <br><br>
Envie d'en savoir plus sur GREEN AGRO VALLEY CI ? Visitez notre page <a href='https://greenagrovalley.org/'>À propos</a>  pour découvrir notre mission, notre équipe et notre engagement envers l'agriculture durable.

 <br><br>
Nous serions ravis d'échanger avec vous. Si vous avez des questions ou des suggestions, n'hésitez pas à nous contacter :
<br><br>
Email : <a href='mailto:info@greenagrovalley.org'>info@greenagrovalley.org</a>
Téléphone : +225 05 84 85 04 97
Merci encore pour votre inscription et votre confiance. Nous sommes impatients de partager avec vous les dernières nouvelles et innovations dans le domaine du forage et de l'irrigation.

 <br><br>

Cordialement,
<br>
L'équipe GREEN AGRO VALLEY CI";
    
    
    // Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';

    $mail->send();
    echo 'Message envoyé avec succès';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
}


}


//pop up 
if (isset($_POST['obtenirLivre'])) {

        $obtenirLivre = $_POST['obtenirLivre'];
        $obtenirLivreTable = explode('&', $obtenirLivre);
        
        // var_dump($obtenirLivreTable);

        $nom = explode('=', $obtenirLivreTable[0]);
        $phone = explode('=', $obtenirLivreTable[1]);
        $email = explode('=', $obtenirLivreTable[2]);
        $profession = explode('=', $obtenirLivreTable[3]);
        $pays = explode('=', $obtenirLivreTable[4]);
        $ville = explode('=', $obtenirLivreTable[5]);
        $service = explode('=', $obtenirLivreTable[6]);


         $ins = $bdd->prepare('INSERT INTO livre(nom, telephone, email, profession, pays, ville, service, dateEnregistrer) VALUES(:nom, :telephone, :email, :profession, :pays, :ville, :service, NOW())');


          $ins->bindParam(':nom', $nom[1]);
          $ins->bindParam(':email', $email[1]);
          $ins->bindParam(':profession', $profession[1]);
          $ins->bindParam(':telephone', $phone[1]);
          $ins->bindParam(':pays', $pays[1]);
          $ins->bindParam(':ville', $ville[1]);
          $ins->bindParam(':service', $service[1]);
          $ins->execute();
          
         
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                              //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress($email[1], ' ');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }
    
    //Attachments
    $mail->addAttachment('img/Livre_sur_le_TOMATE.pdf');         //Add attachments

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'LIVRE SUR LA PRODUCTION DES TOMATES';
    $mail->Body    =
    
     "
    
    Bonjour,

 
<br><br>
Nous vous remercions chaleureusement de vous être inscrit à notre newsletter et nous vous souhaitons la bienvenue chez GREEN AGRO VALLEY CI ! Nous sommes ravis de vous compter parmi nos abonnés et de vous accompagner dans votre aventure vers des solutions de forage et d’irrigation innovantes.
<br>
Découvrez nos ressources populaires
Pour vous donner un aperçu de ce qui vous attend, voici quelques liens vers des pages et articles populaires sur notre site :
<br><br>
<a href='https://greenagrovalley.org/nos-forages.html'>Nos services de forage </a>: Découvrez nos solutions de forage efficaces et durables.<br>
<a href='https://greenagrovalley.org/about.html'>Technologie Laser Spray </a>: En savoir plus sur notre technologie innovante d'irrigation avec Laser Spray.<br>
<a href='https://greenagrovalley.org/'>Témoignages de clients</a> : Lisez les histoires de nos clients satisfaits et voyez comment nos services ont transformé leurs pratiques agricoles.
Optimisation de l'irrigation avec Laser Spray : Découvrez comment la technologie Laser Spray permet une irrigation précise et économe en eau, améliorant ainsi les rendements agricoles et la durabilité. Lire la suite

 <br><br>
Envie d'en savoir plus sur GREEN AGRO VALLEY CI ? Visitez notre page <a href='https://greenagrovalley.org/'>À propos</a>  pour découvrir notre mission, notre équipe et notre engagement envers l'agriculture durable.

 <br><br>
Nous serions ravis d'échanger avec vous. Si vous avez des questions ou des suggestions, n'hésitez pas à nous contacter :
<br><br>
Email : <a href='mailto:info@greenagrovalley.org'>info@greenagrovalley.org</a>
Téléphone : +225 05 84 85 04 97
Merci encore pour votre inscription et votre confiance. Nous sommes impatients de partager avec vous les dernières nouvelles et innovations dans le domaine du forage et de l'irrigation.

 <br><br>
 
 Vous trouverez ci-joint votre livre sur la production des tomates. 
<br><br>
Cordialement,
<br>
L'équipe GREEN AGRO VALLEY CI";
    
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    
    echo 'Message envoyé avec succès';

        } catch (Exception $e) {
        
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
        }


    }
    
    if (isset($_POST['submitFaireDon'])) {

        // var_dump( $_POST['submitFaireDon']);
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
    $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
    $mail->Password   = 'Noreply@2024';                              //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
    $mail->addAddress('devis@greenagrovalley.org', "");  
     // $mail->AddCC('appessika.koffi@greenagrovalley.org', ' '); 
    // $mail->addAddress('abiole68@gmail.com', ' ');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // if (isset($email)) {
    //   $mail->addReplyTo($email, strtoupper($nom));
    // }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'NOUVELLE INSCRIPTION AUX FORMATIONS';
    $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br> Vous avez une nouvelle inscription à la formation sur : '.$typeFormation[1].'<br><br><a src="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// Set UTF-8 encoding
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'Message envoyé avec succès';

        } catch (Exception $e) {
        
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
        }

    }


    // Nous rejoindre
      if (isset($_POST['submitRejoindreWagedo'])) {

        // var_dump( $_POST['submitFaireDon']);
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

// try {
//     //Server settings
//     // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'mail12.lwspanel.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'no-reply@greenagrovalley.org';                     //SMTP username
//     $mail->Password   = 'Noreply@2024';                              //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('no-reply@greenagrovalley.org', 'GREEN AGRO VALLEY CI');
//     $mail->addAddress('devis@greenagrovalley.org', "");  
//      // $mail->AddCC('appessika.koffi@greenagrovalley.org', ' '); 
//     // $mail->addAddress('abiole68@gmail.com', ' ');     //Add a recipient
//     // $mail->addAddress('ellen@example.com');               //Name is optional
//     // if (isset($email)) {
//     //   $mail->addReplyTo($email, strtoupper($nom));
//     // }

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'NOUVELLE INSCRIPTION AUX FORMATIONS';
//     $mail->Body    = 'Hello GREEN AGRO VALLEY CI, <br><br>Je m\'appelle '.$nom[1].' <br><br> Vous avez une nouvelle inscription à la formation sur : '.$typeFormation[1].'<br><br><a src="https://greenagrovalley.org/dashboard.php">Connexion</a>';
// // Set UTF-8 encoding
//     $mail->CharSet = 'UTF-8';
//     $mail->send();
//     echo 'Message envoyé avec succès';

//         } catch (Exception $e) {
        
//             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
//         }

    }

//connexion page administration
if (isset($_POST['connexionPage'])) {

    $connexionPage = htmlspecialchars($_POST['connexionPage']);
// var_dump($newsletter);
    $connexionPage = explode('&', $connexionPage);
    $email = explode('=', $connexionPage[0]);
    $mdp = explode('=', $connexionPage[1]);

    $ins = $bdd->query('SELECT * FROM connexion');
    $ins->execute();
    
    
    
    while($result = $ins->fetch()){
        if($result['email'] === rtrim($email[1])){
        
        if($result['mdp'] === rtrim($mdp[1])){
            
            $_SESSION['admin'] = $result['nom'];
            
            echo "<script>window.location.href='dashboard.php';</script>";
            
        }else{
            echo "Mot de passe n'existe pas";
            break;
        }
        
    }else{
        echo "Votre adresse mail n'existe pas";
    }
    }
    
}

if(isset($_POST['etat'])){
    $id = htmlspecialchars($_POST['id']);
    $etat = htmlspecialchars($_POST['etat']);
    $numeroDevis = htmlspecialchars($_POST['numeroDevis']);
    $dateEnvoieDevis = htmlspecialchars($_POST['dateEnvoieDevis']);
    $agent = htmlspecialchars($_POST['agent']);
    
    $update = $bdd->prepare('UPDATE devis SET agent=:agent, etat=:etat, numeroDevis=:numeroDevis, dateFin=:dateFin WHERE id =:id');
    $update->bindParam(':etat', $etat);
    $update->bindParam(':agent', $agent);
    $update->bindParam(':numeroDevis', $numeroDevis);
    $update->bindParam(':dateFin', $dateEnvoieDevis);
    $update->bindParam(':id', $id);
    $update->execute();
}

    ?>