    <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=wagedobdd;charset=utf8', 'root', '');
            // $bdd = new PDO('mysql:host=127.0.0.1;dbname=green1345274;charset=utf8', 'green1345274', 'green@Bdd1');
        } catch (Exception $e) {
            die('ERREUR '.$e->getMessage());
        }
    ?>