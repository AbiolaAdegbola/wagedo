<?php

ini_set('default_charset', 'UTF-8');


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'connexionBdd.php';

$spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();



$state = $bdd->query('SELECT * FROM devis WHERE typeDevis="forage" ');
$state->execute();
  


$u = 1;

$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('Devis Forage');


$sheet1->setCellValue('A1', 'N°');
$sheet1->setCellValue('B1', 'Nom');
$sheet1->setCellValue('C1', 'Contact');
$sheet1->setCellValue('D1', 'Email');
$sheet1->setCellValue('E1', 'Ville');
$sheet1->setCellValue('F1', 'Budget');
$sheet1->setCellValue('G1', 'Date de demande');
$sheet1->setCellValue('H1', 'Etat');
$sheet1->setCellValue('I1', 'Numéro de devis');
$sheet1->setCellValue('J1', 'Date Envoyée');
$sheet1->setCellValue('K1', 'Decouvert');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet1->setCellValue('A'.$i, $u);
    $sheet1->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet1->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet1->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet1->setCellValue('E'.$i, $devisForageInfo['ville']);
    $sheet1->setCellValue('F'.$i, $devisForageInfo['budget']);
    $sheet1->setCellValue('G'.$i, $devisForageInfo['date_devis']);
    $sheet1->setCellValue('H'.$i, $devisForageInfo['etat']);
    $sheet1->setCellValue('I'.$i, $devisForageInfo['numeroDevis']);
    $sheet1->setCellValue('J'.$i, $devisForageInfo['dateFin']);
    $sheet1->setCellValue('K'.$i, $devisForageInfo['decouvert']);

$u++;
}

$state->closeCursor();


//REPORTING DEVIS LASER
$state = $bdd->query('SELECT * FROM devis WHERE typeDevis="laserSpray" ');
$state->execute();
  


$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Devis LASER SPRAY');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Nom');
$sheet2->setCellValue('C1', 'Contact');
$sheet2->setCellValue('D1', 'Email');
$sheet2->setCellValue('E1', 'Ville');
$sheet2->setCellValue('F1', 'Budget');
$sheet2->setCellValue('G1', 'Date de demande');
$sheet2->setCellValue('H1', 'Etat');
$sheet2->setCellValue('I1', 'Numéro de devis');
$sheet2->setCellValue('J1', 'Date Envoyée');
$sheet2->setCellValue('K1', 'Decouvert');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet2->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('E'.$i, $devisForageInfo['ville']);
    $sheet2->setCellValue('F'.$i, $devisForageInfo['budget']);
    $sheet2->setCellValue('G'.$i, $devisForageInfo['date_devis']);
    $sheet2->setCellValue('H'.$i, $devisForageInfo['etat']);
    $sheet2->setCellValue('I'.$i, $devisForageInfo['numeroDevis']);
    $sheet2->setCellValue('J'.$i, $devisForageInfo['dateFin']);
    $sheet2->setCellValue('K'.$i, $devisForageInfo['decouvert']);

$u++;
}

$state->closeCursor();




//FORAGE + LASER
$state = $bdd->query('SELECT * FROM devis WHERE typeDevis="foragepluslaser" ');
$state->execute();
  


$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('FORAGE + LASER SPRAY');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Nom');
$sheet2->setCellValue('C1', 'Contact');
$sheet2->setCellValue('D1', 'Email');
$sheet2->setCellValue('E1', 'Ville');
$sheet2->setCellValue('F1', 'Budget');
$sheet2->setCellValue('G1', 'Date de demande');
$sheet2->setCellValue('H1', 'Etat');
$sheet2->setCellValue('I1', 'Numéro de devis');
$sheet2->setCellValue('J1', 'Date Envoyée');
$sheet2->setCellValue('K1', 'Decouvert');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet2->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('E'.$i, $devisForageInfo['ville']);
    $sheet2->setCellValue('F'.$i, $devisForageInfo['budget']);
    $sheet2->setCellValue('G'.$i, $devisForageInfo['date_devis']);
    $sheet2->setCellValue('H'.$i, $devisForageInfo['etat']);
    $sheet2->setCellValue('I'.$i, $devisForageInfo['numeroDevis']);
    $sheet2->setCellValue('J'.$i, $devisForageInfo['dateFin']);
    $sheet2->setCellValue('K'.$i, $devisForageInfo['decouvert']);

$u++;
}

$state->closeCursor();



//REPORTING DEVIS LASER
$state = $bdd->query('SELECT * FROM devis WHERE typeDevis="commande" ');
$state->execute();
  


$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Poduits commandés');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Nom');
$sheet2->setCellValue('C1', 'Contact');
$sheet2->setCellValue('D1', 'Email');
$sheet2->setCellValue('E1', 'Ville');
$sheet2->setCellValue('F1', 'Budget');
$sheet2->setCellValue('G1', 'Date de demande');
$sheet2->setCellValue('H1', 'Etat');
$sheet2->setCellValue('I1', 'Numéro de devis');
$sheet2->setCellValue('J1', 'Date Envoyée');
$sheet2->setCellValue('K1', 'Decouvert');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet2->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('E'.$i, $devisForageInfo['ville']);
    $sheet2->setCellValue('F'.$i, $devisForageInfo['budget']);
    $sheet2->setCellValue('G'.$i, $devisForageInfo['date_devis']);
    $sheet2->setCellValue('H'.$i, $devisForageInfo['etat']);
    $sheet2->setCellValue('I'.$i, $devisForageInfo['numeroDevis']);
    $sheet2->setCellValue('J'.$i, $devisForageInfo['dateFin']);
    $sheet2->setCellValue('K'.$i, $devisForageInfo['decouvert']);

$u++;
}

$state->closeCursor();


//LIVRE TELECHARGER
$state = $bdd->query('SELECT * FROM livre ');
$state->execute();
  


$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('LIVRE TELECHARGER');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Nom');
$sheet2->setCellValue('C1', 'Contact');
$sheet2->setCellValue('D1', 'Email');
$sheet2->setCellValue('E1', 'Ville');
$sheet2->setCellValue('F1', 'Profession');
$sheet2->setCellValue('G1', 'Interressé par');
$sheet2->setCellValue('H1', 'Date');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet2->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('E'.$i, $devisForageInfo['ville']);
    $sheet2->setCellValue('F'.$i, $devisForageInfo['profession']);
    $sheet2->setCellValue('G'.$i, $devisForageInfo['service']);
    $sheet2->setCellValue('H'.$i, $devisForageInfo['dateEnregistrer']);

$u++;
}

$state->closeCursor();


//LIVRE TELECHARGER
$state = $bdd->query('SELECT * FROM livre ');
$state->execute();
  


$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('LIVRE TELECHARGER CAMPAGNE');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Nom');
$sheet2->setCellValue('C1', 'Contact');
$sheet2->setCellValue('D1', 'Email');
$sheet2->setCellValue('E1', 'Ville');
$sheet2->setCellValue('F1', 'Profession');
$sheet2->setCellValue('G1', 'Interressé par');
$sheet2->setCellValue('H1', 'Date');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet2->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('E'.$i, $devisForageInfo['ville']);
    $sheet2->setCellValue('F'.$i, $devisForageInfo['profession']);
    $sheet2->setCellValue('G'.$i, $devisForageInfo['service']);
    $sheet2->setCellValue('H'.$i, $devisForageInfo['dateEnregistrer']);

$u++;
}

$state->closeCursor();

//LIVRE TELECHARGER
$state = $bdd->query('SELECT * FROM formation ');
$state->execute();
  


$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('FORMATIONS');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Nom');
$sheet2->setCellValue('C1', 'Contact');
$sheet2->setCellValue('D1', 'Email');
$sheet2->setCellValue('E1', 'Profession');
$sheet2->setCellValue('F1', 'Formation');
$sheet2->setCellValue('G1', 'Ville');
$sheet2->setCellValue('H1', 'decouvert');
$sheet2->setCellValue('I1', 'Date');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet2->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('E'.$i, $devisForageInfo['profession']);
    $sheet2->setCellValue('F'.$i, $devisForageInfo['typeFormation']);
    $sheet2->setCellValue('G'.$i, $devisForageInfo['ville']);
    $sheet2->setCellValue('H'.$i, $devisForageInfo['decouvert']);
    $sheet2->setCellValue('I'.$i, $devisForageInfo['dateEnregistrer']);

$u++;
}

$state->closeCursor();



// Enregistrer le fichier Excel
$writer = new Xlsx($spreadsheet);
$filename = 'reporting-gav-ci.xlsx';



try {
    $writer->save($filename);
    echo "Fichier Excel crée avec succès : $filename";
} catch (Exception $e) {
    echo "Erreur lors de la création du fichier Excel : ", $e->getMessage();
}
?>
