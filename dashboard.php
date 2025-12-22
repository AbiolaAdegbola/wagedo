<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">
  <title>Dashboard - WAGEDO</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Customized Bootstrap Stylesheet -->
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    body {
      display: flex;
      background-color: #f5f6fa;
    }
    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #fff;
      /* padding: 20px; */
      display: flex;
      flex-direction: column;
      height: 100vh;
      border-right: 1px solid #e0e0e0;
      position: fixed;
    }
    .sidebar h2 {
      /* margin-bottom: 20px; */
      font-size: 20px;
      color: #0a7b2b;
    }
    .sidebar a {
      text-decoration: none;
      color: #4a4a4a;
      padding: 10px;
      display: flex;
      align-items: center;
      border-radius: 5px;
      transition: 0.3s;
    }
    .sidebar a:hover {
      background-color: #0a7b2c28;
      color: #0a7b2b;
    }
    
    .DashboardBoutonActive
    {
        background-color: #0a7b2c3a;
      color: #0a7b2b;
    }
    
    .sidebar a i {
      margin-right: 10px;
    }
    .sidebar .upgrade {
      margin-top: auto;
      text-align: center;
    }
    .sidebar .upgrade button {
      background-color: red;
      color: #fff;
      padding: 2px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
      margin-bottom:10px
    }
    .sidebar .upgrade button a{
      color: #fff;
    }
    
    .sidebar .upgrade button a:hover{
      color: #fff;
      background-color:red;
    }

    /* Main content */
    .main-content {
      flex: 1;
      padding: 20px;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .top-bar input[type="search"] {
      padding: 8px;
      width: 250px;
      border-radius: 20px;
      border: 1px solid #e0e0e0;
    }
    .top-bar .user-info img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-left: 10px;
    }

    /* Dashboard Cards */
    .dashboard-cards {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .card {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      width: calc(33.33% - 20px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card h3 {
      font-size: 18px;
      color: #333;
      margin-bottom: 10px;
    }
    .card h2 {
      font-size: 28px;
      color: #0a7b2b;
    }
    .card .badge {
      background-color: #e5e7eb;
      color: #0a7b2b;
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 12px;
      display: inline-block;
    }
    
/* Main container styling */
.containerElementDashboardDevis {
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Heading styling */
.containerElementDashboardDevis h2 {
  color: #0a7b2b;
  font-size: 24px;
  margin-bottom: 10px;
}

.containerElementDashboardDevis p {
  color: #666;
  font-size: 14px;
  margin-bottom: 20px;
}

/* Table styling */
.table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  font-size: 14px;
  color: #333;
}

.table thead th {
  background-color: green;
  color: #fff;
  padding: 12px;
  text-align: left;
  font-weight: bold;
  border-bottom: 2px solid #e0e0e0;
}

.table tbody tr {
  border-bottom: 1px solid #e0e0e0;
}

.table tbody tr:nth-child(even) {
  background-color: #f7f7f7;
}

.table tbody td {
  padding: 12px;
  vertical-align: middle;
  font-size: 13px;
}

/* Hover and active row styling */
.table tbody tr:hover {
  background-color: rgba(192,192,192,0.3);
  cursor: pointer;
}

  </style>
  

</head>
<body>
    
    <?php
    
        if(isset($_SESSION['admin'])){ ?>

  <!-- Sidebar -->
<div class="sidebar">
  <h2 style="text-align: center; font-size: 24px; font-weight: bold; padding: 20px;">WAGEDO</h2>

  <a href="#" class="clickBoutonDashboard clickBoutonDashboard1 DashboardBouton DashboardBoutonActive" data-id="1">
    <i class="fas fa-tachometer-alt"></i> Dashboard
  </a>

  <a href="#" class="clickBoutonDashboard clickBoutonDashboard2 DashboardBouton" data-id="2">
    <i class="fas fa-newspaper"></i> Actualités
  </a>

  <a href="#" class="clickBoutonDashboard clickBoutonDashboard3 DashboardBouton" data-id="3">
    <i class="fas fa-project-diagram"></i> Projets
  </a>

  <a href="#" class="clickBoutonDashboard clickBoutonDashboard4 DashboardBouton" data-id="4">
    <i class="fas fa-handshake"></i> Demande de partenariat
  </a>

  <a href="#" class="clickBoutonDashboard clickBoutonDashboard5 DashboardBouton" data-id="5">
    <i class="fas fa-donate"></i> Donateurs
  </a>

  <a href="#" class="clickBoutonDashboard clickBoutonDashboard6 DashboardBouton" data-id="6">
    <i class="fas fa-users"></i> Rejoindre la communauté
  </a>

  <a href="#" class="clickBoutonDashboard clickBoutonDashboard7 DashboardBouton" data-id="7">
    <i class="fas fa-envelope-open-text"></i> Newsletters
  </a>

  <a href="#" class="clickBoutonDashboard clickBoutonDashboard8 DashboardBouton" data-id="8">
    <i class="fas fa-comments"></i> Message visiteur
  </a>

  <div class="upgrade">
    <button>
      <a href="deconnexion.php"><i class="fas fa-door-open"></i> Déconnexion</a>
    </button>
  </div>
</div>

  <!-- Main Content -->
  <div class="main-content" style="margin-left:250px;">
    <!-- Top Bar -->
    <div class="top-bar">
<div style="background-color: orange; padding:10px; text-align: center; border-radius: 10px; cursor: pointer; color:white" 
     class="reporting" 
     onclick="handleReportingDownload()">
    <i class="fas fa-upload"></i> Reporting
</div>

<!--CODE JAVASCRIPT-->
<script type="text/javascript">
  function handleReportingDownload() {
    // Appeler le fichier reporting.php
    fetch('reporting.php')
      .then(response => {
        if (response.ok) {
          // Si l'appel a réussi, télécharger le fichier Excel
          downloadFile('reporting-gav-ci.xlsx');
        } else {
          console.error('Erreur lors de l\'appel à reporting.php');
        }
      })
      .catch(error => {
        console.error('Erreur de réseau :', error);
      });
  }

  function downloadFile(url) {
    const link = document.createElement('a');
    link.href = url;
    link.download = ''; // Utilise le nom du fichier du serveur
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }
</script>
      
      <div class="user-info">
        <i class="fas fa-bell"></i>
        <i class="fas fa-user" style="margin-left:15px"></i><span style="margin-left:5px"><?php echo($_SESSION['admin']); ?></span>
        <!--<img src="https://via.placeholder.com/40" alt="User Image">-->
      </div>
    </div>


<div class="loadingBouton"></div>
 <div class="conteneurPageDashboard">
     
     
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
      
    </div>
     
 </div>


  </div>
  
  <?php }else{?>
        
        <div style="height: 90vh; position: relative;">

                <!-- Contact Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h2 class="fw-bold text-psecondary text-uppercase">Connexion</h2>
                <h5 class="mb-0 text-secondary">Réservée uniquement aux administrateurs de WAGEDO</h5>
            </div>
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="mb-2">Appelez pour poser n’importe quelle question</h6>
                            <h6 class="text-primary mb-0"><a href="tel:0022500000000" class="text-primary">+225 00 00 00 00 00</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                        <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="mb-2">Envoyez un e-mail</h6>
                            <h6 class="text-primary mb-0"><a href="mailto:info@wagedo-h2.org" class="text-primary">info@wagedo-h2.org</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                        <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h6 class="mb-2">Visitez nos locaux</h6>
                            <h6 class="text-primary mb-0">Côte d'ivoire, Abidjan</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s" style="height: 300px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2499.4772579202804!2d6.829639092623757!3d51.21028325952526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b8cb9335e1bd4b%3A0xf7d122b86794412f!2sWohnungsgenossenschaft%20Dusseldorf-Ost%20e.%20G.%20(WOGEDO)!5e0!3m2!1sfr!2sci!4v1765889403864!5m2!1sfr!2sci" width="600" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s" style="height: 300px;">
                    <form id="connexionPage">
                        <div class="row g-3">
                           
                            <div class="col-md-12">
                                <input type="email" name="email" class="form-control border-0 px-4" placeholder="Votre Email" style="height: 55px;" required>
                            </div>
                            <div class="col-12">
                                <input type="password" name="mdp" class="form-control border-0 px-4" placeholder="Votre mot de passe" style="height: 55px;" required>
                            </div>

                             <input type="text" name="envoyerFormConnexion" style="display:none">

                            <div class="responseConnexion" style="background-color: red; color: white; text-align: center; padding: 10px; display: none;"></div>
                            <div class="spinner-grow loadingBoutonConnexion containerDisplayNone" style="color: orange; display:none" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                            
                            <div class="col-12">
                                <button class="btn btn-secondary w-100 py-3 envoyerFormConnexion" type="submit">connexion</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Contact End -->
    
        </div>
        
    <?php  }?>
      
      <div class="modal fade" id="dashboardDevisModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content " style="background: rgba(255, 255, 255, .8);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-danger text-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-items-center justify-content-center contentModal">
                   
                </div>
            </div>
        </div>
      </div>

    <!-- JavaScript Libraries -->
    <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/main_dashboard.js"></script>

    <script>
  // Suppression d'un article
  document.addEventListener("click", async (e) => {
    // Vérifie si le bouton cliqué a la classe "delete_article" ou son icône interne
    const deleteBtn = e.target.closest(".delete_article");
    if (!deleteBtn) return;

    e.preventDefault();

    const id_article = deleteBtn.getAttribute("data-id");
    const ligneArticle = deleteBtn.closest("tr");

    if (!id_article) return alert("ID article introuvable.");

    if (!confirm("Voulez-vous vraiment supprimer cet article ?")) return;

    try {
      const response = await fetch("delete_actualite.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ id: id_article }),
      });

      const result = await response.json();

      if (result.success) {
        ligneArticle.style.transition = "opacity 0.5s ease";
        ligneArticle.style.opacity = "0";
        setTimeout(() => ligneArticle.remove(), 500);
      } else {
        alert(result.message || "Erreur lors de la suppression.");
      }
    } catch (error) {
      console.error("Erreur :", error);
      alert("Une erreur est survenue.");
    }
  });

    // Suppression d'un projet
  document.addEventListener("click", async (e) => {
    // Vérifie si le bouton cliqué a la classe "delete_article" ou son icône interne
    const deleteBtn = e.target.closest(".delete_projet");
    if (!deleteBtn) return;

    e.preventDefault();

    const id_article = deleteBtn.getAttribute("data-id");
    const ligneArticle = deleteBtn.closest("tr");

    if (!id_article) return alert("ID article introuvable.");

    if (!confirm("Voulez-vous vraiment supprimer cet article ?")) return;

    try {
      const response = await fetch("delete_projet.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ id: id_article }),
      });

      const result = await response.json();

      if (result.success) {
        ligneArticle.style.transition = "opacity 0.5s ease";
        ligneArticle.style.opacity = "0";
        setTimeout(() => ligneArticle.remove(), 500);
      } else {
        alert(result.message || "Erreur lors de la suppression.");
      }
    } catch (error) {
      console.error("Erreur :", error);
      alert("Une erreur est survenue.");
    }
  });

  $(document).on('click', '.onclickDetailModal', function (e) {
  e.preventDefault();

  const id = $(this).data('id');

  const data_id = id.split("@]")

  $.ajax({
    type: 'POST',
    url: 'dashboard-modal-donateur.php',
    data: { modalDetail: data_id[0], table: data_id[1] },
    beforeSend: function() {
      $('.contentModal').html('<div style="padding:20px;text-align:center;">Chargement...</div>');
    },
    success: function (response) {
      $('.contentModal').html(response);
      $('#dashboardDevisModal').modal('show');
    },
    error: function() {
      alert('Erreur lors du chargement du détail.');
    }
  });
});

</script>

</body>
</html>
