<?php

include 'connexionBdd.php';

if (isset($_POST['modalDetail'])) {

	$idModal = htmlspecialchars($_POST['modalDetail']);
	$table = htmlspecialchars($_POST['table']);

	// ✅ Liste blanche des tables autorisées
	$allowedTables = ['donateur', 'actualite', 'partenariat', 'projets', "message_visiteur", 'nous_rejoindre', "alaune"];

	if (!in_array($table, $allowedTables)) {
		die('Table non autorisée');
	}

	// ⚠️ Insère le nom de la table validé directement dans la requête
	$sql = "SELECT * FROM $table WHERE id = :id";
	$cursor = $bdd->prepare($sql);
	$cursor->bindParam(':id', $idModal, PDO::PARAM_INT);
	$cursor->execute();

	$result = $cursor->fetch(PDO::FETCH_ASSOC);

	if ($table !== "message_visiteur" && $table !== "alaune" && $table !== "projets") {
?>

		<div class="container" style="color: black; position: relative;">

			<i class="fa fa-user" style="font-size: 35px;"></i>
			<div class="d-flex align-items-center" style="text-transform: capitalize;">Nom : <h4 style="margin-left: 20px;"><?php echo ($result['nom']); ?></h4>
			</div>
			<div class="d-flex align-items-center">Telephone : <h4 style="margin-left: 20px;"><a href="tel:<?php echo ($result['telephone']); ?>"><?php echo ($result['telephone']); ?></a></h4>
			</div>
			<div class="d-flex align-items-center">Email : <h4 style="margin-left: 20px;"><a href="mailto:<?php echo ($result['email']); ?>"><?php echo ($result['email']); ?></a></h4>
			</div>
			<div class="d-flex align-items-center">Pays : <h4 style="margin-left: 20px;"><?php echo ($result['pays']); ?></h4>
			</div>

			<?php if ($table === "donateur") { ?>
				<div class="d-flex align-items-center">Mode de paiement : <h4 style="margin-left: 20px;"><?php echo ($result['mode_paiement']); ?></h4>
				</div>
				<div class="d-flex align-items-center">Montant du Don : <h4 style="margin-left: 20px;"><?php echo ($result['montant']); ?></h4>
				</div>

				<div style="margin-top: 20px; ">
					<strong style="font-size: 18px">Membre WAGEDO :</strong><br>

					<div class="d-flex align-items-center">Nom de la personne qui a reçu le Don : <h4 style="margin-left: 20px;"><?php echo ($result['nom_person_receive_money']); ?></h4>
					</div>
				</div>

				<div style="margin-top: 20px; ">
					<strong style="font-size: 18px">Message :</strong><br>
					<div><?php echo ($result['message']); ?></div>
				</div>

			<?php }
			if ($table === "nous_rejoindre") { ?>
				<div class="d-flex align-items-center">Ville : <h4 style="margin-left: 20px;"><?php echo ($result['ville']); ?></h4>
				</div>
				<div class="d-flex align-items-center">Profession : <h4 style="margin-left: 20px;"><?php echo ($result['profession']); ?></h4>
				</div>
				<div class="d-flex align-items-center">Raison : <h4 style="margin-left: 20px;"><?php echo ($result['raison']); ?></h4>
				</div>
				<div style="margin-top: 20px; ">
					<strong style="font-size: 18px">Message :</strong><br>
					<div><?php echo ($result['message']); ?></div>
				</div>
			<?php }
			if ($table === "partenariat") { ?>
				<div class="d-flex align-items-center">Ville : <h4 style="margin-left: 20px;"><?php echo ($result['ville']); ?></h4>
				</div>
				<div class="d-flex align-items-center">Type de partenariat : <h4 style="margin-left: 20px;"><?php echo ($result['partenariat']); ?></h4>
				</div>
				<div class="d-flex align-items-center">Raison : <h4 style="margin-left: 20px;"><?php echo ($result['raison']); ?></h4>
				</div>
				<div style="margin-top: 20px; ">
					<strong style="font-size: 18px">Message :</strong><br>
					<div><?php echo ($result['descriptionPartenariat']); ?></div>
				</div>
			<?php } ?>

		<?php } elseif ($table === "message_visiteur") {
		?>

			<div class="container" style="color: black; position: relative;">

				<i class="fa fa-user" style="font-size: 35px;"></i>
				<div class="d-flex align-items-center" style="text-transform: capitalize;">Nom : <h4 style="margin-left: 20px;"><?php echo ($result['nom']); ?></h4>
				</div>
				<div class="d-flex align-items-center">Email : <h4 style="margin-left: 20px;"><a href="mailto:<?php echo ($result['email']); ?>"><?php echo ($result['email']); ?></a></h4>
				</div>
				<div class="d-flex align-items-center">Sujet : <h4 style="margin-left: 20px;"><?php echo ($result['titre']); ?></h4>
				</div>

				<div style="margin-top: 20px; ">

					<div style="margin-top: 20px; ">
						<strong style="font-size: 18px">Message :</strong><br>
						<div><?php echo ($result['contenu']); ?></div>
					</div>


				<?php } elseif ($table === "alaune") {
				?>

					<div class="container" style="color: black; position: relative;">

						<i class="fa fa-user" style="font-size: 35px;"></i>
						<div class="d-flex align-items-center" style="text-transform: capitalize;">Auteur : <h4 style="margin-left: 20px;"><?php echo ($result['auteur']); ?></h4>
						</div>

						<div style="margin-top: 20px; ">

							<div style="margin-top: 20px; ">
								<strong style="font-size: 18px">Informations :</strong><br>
								<div><?php echo ($result['titre']); ?></div>
							</div>


					<?php } elseif ($table === "projets") {
		?>

			<div class="container" style="color: black; position: relative;">

			<div style="position: absolute; right:40px; top:-20px">
				<div>Etat du projet</div>
				<select id="etat_projet" style="padding: 8px;" data-id="<?php echo($result['id']); ?>">
					<option value="<?php echo($result['etat']); ?>"><?php echo($result['etat'] === '0' ? 'En cours' : 'Terminé'); ?></option>
					<option value="0">En cours</option>
					<option value="1">Terminé</option>
				</select>
			</div>

			<div>
				<a href="projet-single.html?categorie=<?= urlencode($result['categorie']); ?>&titre=<?= urlencode($result['titre']); ?>&id=<?= $result['id']; ?>" style="color:blue; font-size:15px; margin-right:10px">
              <i class="bi bi-eye"></i> Voir le projet complet
            </a>
            <!-- ✅ ajout de data-id -->
            <span class="delete_projet" data-id="<?= $result['id']; ?>" style="color:red; font-size:15px; cursor:pointer;">
              <i class="bi bi-trash"></i> Supprimer le projet
            </span>
			</div>

				<i class="fa fa-user" style="font-size: 35px;"></i>
				<div class="d-flex align-items-center" style="text-transform: capitalize;">Auteur : <h4 style="margin-left: 20px;"><?php echo ($result['auteur']); ?></h4>
				</div>
				</div>
				<div class="d-flex align-items-center">Titre : <h4 style="margin-left: 20px;"><?php echo ($result['titre']); ?></h4>
				</div>

				<div style="margin-top: 20px; ">

					<div style="margin-top: 20px; ">
						<strong style="font-size: 18px">contenu du projet :</strong><br>
						<div><?php echo ($result['contenu']); ?></div>
					</div>
				</div>

				<?php }
			} ?>


<script type="text/javascript">
 	   $('#etat_projet').change('click', function(e){
      e.preventDefault()
      
      var id = $(this).data("id")
      var etat_projet = $("#etat_projet").val()
      
      $.ajax({
      type: 'POST',
      url: 'back_data.php',
      data: {id: id, etat_projet: etat_projet},

      success: function(response) {
        
        // $('.demandeLivrePopUpEnvoyer').html(response);
        
      }
    });
      
  })
 </script>