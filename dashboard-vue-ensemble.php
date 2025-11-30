<?php 

	include 'connexionBdd.php';
	
	
	
	$state = $bdd->query('SELECT * FROM donateur');
	$state->execute();

	$donateurData = $state->rowCount();

	$state->closeCursor();


	$state = $bdd->query('SELECT * FROM nous_rejoindre');
	$state->execute();

	$nousRejoindreData = $state->rowCount();
	
	$state = $bdd->query('SELECT * FROM partenariat');
	$state->execute();

	$partenariatData = $state->rowCount();

	$state->closeCursor();
	
	$stateVisiteur = $bdd->query('SELECT * FROM visiteur');
	$stateVisiteur->execute();

	$visiteur = $stateVisiteur->fetch();
	
	$labels = explode(", ", $visiteur['mois']);
	$data = explode(", ", $visiteur['nombre']);

	$stateVisiteur->closeCursor();

?>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
             <div class="card">
            <h3>Donateurs</h3>
            <h2>T= <?php echo($donateurData); ?></h2>
            <!-- <span style="font-weight:bold">Non traité : <?php echo($donateurDataNon); ?> </span> -->
        </div>
    
      <div class="card">
        <h3>Nous-rejoindre</h3>
        <h2>T= <?php echo($nousRejoindreData); ?></h2>
        <!-- <span style="font-weight:bold">Non traité : <?php echo($nousRejoindreDataNonTraite); ?> </span> -->
      </div>
      <div class="card">
        <h3>Demande de partenariat</h3>
        <h2>T= <?php echo($partenariatData); ?></h2>
        <!-- <span style="font-weight:bold">Non traité : <?php echo($partenariatDataNonTraite); ?> </span> -->
      </div>
      
          <!-- Profile Report Card -->
    
                 <div class="card" style="width: 100%">
        <h3>Statistique des visiteurs</h3>
        <h2><?php echo($visiteur['count']); ?></h2>
        <canvas id="myChart" width="400" height="200"></canvas>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Visiteurs',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>  
  
</div>
     