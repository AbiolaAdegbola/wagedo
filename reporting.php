<?php

ini_set('default_charset', 'UTF-8');


require 'office/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'connexionBdd.php';

$spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();



$state = $bdd->query('SELECT * FROM donateur ORDER BY id desc ');
$state->execute();
  
$u = 1;

$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('Donateurs');


$sheet1->setCellValue('A1', 'N°');
$sheet1->setCellValue('B1', 'Nom');
$sheet1->setCellValue('C1', 'Contact');
$sheet1->setCellValue('D1', 'Email');
$sheet1->setCellValue('E1', 'Mode de paiement');
$sheet1->setCellValue('F1', 'Montant');
$sheet1->setCellValue('G1', 'Nom de la personne qui a reçu le Don');
$sheet1->setCellValue('H1', 'Etat');
$sheet1->setCellValue('I1', 'Date');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet1->setCellValue('A'.$i, $u);
    $sheet1->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet1->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet1->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet1->setCellValue('E'.$i, $devisForageInfo['mode_paiement']);
    $sheet1->setCellValue('F'.$i, $devisForageInfo['montant']);
    $sheet1->setCellValue('G'.$i, $devisForageInfo['nom_person_receive_money']);
    $sheet1->setCellValue('H'.$i, $devisForageInfo['etat']);
    $sheet1->setCellValue('I'.$i, $devisForageInfo['date_don']);

$u++;
}

$state->closeCursor();


//REPORTING DEVIS LASER
$state = $bdd->query('SELECT * FROM nous_rejoindre ORDER BY id desc ');
$state->execute();

$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Nous-rejoindre');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Nom');
$sheet2->setCellValue('C1', 'Contact');
$sheet2->setCellValue('D1', 'Email');
$sheet2->setCellValue('E1', 'Profession');
$sheet2->setCellValue('F1', 'Pays');
$sheet2->setCellValue('G1', 'Ville');
$sheet2->setCellValue('H1', 'Raison');
$sheet2->setCellValue('I1', 'Message');
$sheet2->setCellValue('J1', 'Date');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet2->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('E'.$i, $devisForageInfo['profession']);
    $sheet2->setCellValue('F'.$i, $devisForageInfo['pays']);
    $sheet2->setCellValue('G'.$i, $devisForageInfo['ville']);
    $sheet2->setCellValue('H'.$i, $devisForageInfo['raison']);
    $sheet2->setCellValue('I'.$i, $devisForageInfo['message']);
    $sheet2->setCellValue('J'.$i, $devisForageInfo['createdAt']);

$u++;
}

$state->closeCursor();


//REPORTING PARTENARIAT
$state = $bdd->query('SELECT * FROM partenariat ORDER BY id desc ');
$state->execute();

$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Demande de partenariat');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Nom');
$sheet2->setCellValue('C1', 'Contact');
$sheet2->setCellValue('D1', 'Email');
$sheet2->setCellValue('E1', 'Pays');
$sheet2->setCellValue('F1', 'Ville');
$sheet2->setCellValue('G1', 'Partenarait');
$sheet2->setCellValue('H1', 'Raison');
$sheet2->setCellValue('I1', 'Description du partenariat');
$sheet2->setCellValue('J1', 'Date');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['nom']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['telephone']);
    $sheet2->setCellValue('D'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('E'.$i, $devisForageInfo['pays']);
    $sheet2->setCellValue('F'.$i, $devisForageInfo['ville']);
    $sheet2->setCellValue('G'.$i, $devisForageInfo['partenariat']);
    $sheet2->setCellValue('H'.$i, $devisForageInfo['raison']);
    $sheet2->setCellValue('I'.$i, $devisForageInfo['descriptionPartenariat']);
    $sheet2->setCellValue('J'.$i, $devisForageInfo['createdAt']);

$u++;
}

$state->closeCursor();


//REPORTING NEWSLETTERS
$state = $bdd->query('SELECT * FROM newsletters ORDER BY id desc ');
$state->execute();

$u = 1;

$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Newsletters');


$sheet2->setCellValue('A1', 'N°');
$sheet2->setCellValue('B1', 'Email');
$sheet2->setCellValue('C1', 'Date');

while($devisForageInfo = $state->fetch()){
$i = $u+1;
    $sheet2->setCellValue('A'.$i, $u);
    $sheet2->setCellValue('B'.$i, $devisForageInfo['email']);
    $sheet2->setCellValue('C'.$i, $devisForageInfo['createdAt']);
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
