    <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=wagedobdd;charset=utf8', 'root', '');
            // $bdd = new PDO('mysql:host=127.0.0.1;dbname=waged2716405;charset=utf8', 'waged2716405', 'wagedoBdd@2025');
        } catch (Exception $e) {
            die('ERREUR '.$e->getMessage());
        }
    ?>