<?php
include 'connexionBdd.php';

// --------- IP du visiteur ---------
$ip = $_SERVER['REMOTE_ADDR'];
$jour = date('Y-m-d'); // format : 2025-07-16

// --------- Vérifie si cette IP a déjà été comptée aujourd’hui ---------
$check = $bdd->prepare("SELECT COUNT(*) FROM visites_jour WHERE ip = :ip AND jour = :jour");
$check->execute(['ip' => $ip, 'jour' => $jour]);
$dejaCompte = $check->fetchColumn() > 0;
$check->closeCursor();

if (!$dejaCompte) {
    // --------- Enregistrer la visite dans la table visites_jour ---------
    $insert = $bdd->prepare("INSERT INTO visites_jour (ip, jour) VALUES (:ip, :jour)");
    $insert->execute(['ip' => $ip, 'jour' => $jour]);
    $insert->closeCursor();

    // --------- Récupération des données globales ---------
    $result = $bdd->query("SELECT * FROM visiteur");
    $visiteurData = $result->fetch();
    $result->closeCursor();

    if (!$visiteurData) {
        exit("Erreur : données de visiteurs introuvables.");
    }

    $count = (int)$visiteurData['count'];
    $nombre = !empty($visiteurData['nombre']) ? explode(', ', $visiteurData['nombre']) : [];
    $mois = !empty($visiteurData['mois']) ? explode(', ', $visiteurData['mois']) : [];
    $etat = (int)$visiteurData['etat'];
    $jourActuel = date('j');
    $dateComplete = date("d/m/Y");

    // --------- Traitement du compteur ---------
    if ($jourActuel != 5) {
        $count++;
        $nombre[count($nombre) - 1] = $count;
        $etat = 1;

        $req = $bdd->prepare("UPDATE visiteur SET count = :count, nombre = :nombre, etat = :etat");
        $req->bindValue(':count', $count, PDO::PARAM_INT);
        $req->bindValue(':nombre', implode(', ', $nombre), PDO::PARAM_STR);
        $req->bindValue(':etat', $etat, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    } else {
        if ($etat === 1) {
            $mois[] = $dateComplete;
            $nombre[] = $count;
            $count = 0;
            $etat = 0;

            $req = $bdd->prepare("UPDATE visiteur SET count = :count, nombre = :nombre, mois = :mois, etat = :etat");
            $req->bindValue(':count', $count, PDO::PARAM_INT);
            $req->bindValue(':nombre', implode(', ', $nombre), PDO::PARAM_STR);
            $req->bindValue(':mois', implode(', ', $mois), PDO::PARAM_STR);
            $req->bindValue(':etat', $etat, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        } else {
            $count++;
            $nombre[count($nombre) - 1] = $count;

            $req = $bdd->prepare("UPDATE visiteur SET count = :count, nombre = :nombre");
            $req->bindValue(':count', $count, PDO::PARAM_INT);
            $req->bindValue(':nombre', implode(', ', $nombre), PDO::PARAM_STR);
            $req->execute();
            $req->closeCursor();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>WAGEDO - West African Green Energy Development Organisation</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <div class="gtranslate_wrapper"></div>
  <script>window.gtranslateSettings = { "default_language": "en", "languages": ["en", "es", "pt", "fr"], "wrapper_selector": ".gtranslate_wrapper", "float_switcher_open_direction": "bottom", "alt_flags": { "en": "usa" } }</script>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

</head>

<body>

  <!-- 🔔 Bandeau d’actualités WAGEDO -->
<div class="news-container">
  <div class="news-title">📰 ACTUALITÉS WAGEDO</div>
  <div class="news-marquee" id="newsMarquee">
    <span>
      🌱 WAGEDO lance un nouveau programme pour les jeunes entrepreneurs agricoles —
      💡 Webinaire sur l’innovation durable, ce vendredi à 18h —
      🤝 Nouveau partenariat stratégique avec l’ONG Terre Verte —
      🌍 Campagne de reboisement prévue ce samedi à Abidjan —
      📈 Les membres de WAGEDO bénéficient d’un espace collaboratif en ligne !
    </span>
  </div>
</div>

<script>
/* 💡 Option dynamique : les actualités peuvent venir d'un tableau JS */
const newsList = [
  "🌱 WAGEDO lance un programme de formation agricole pour 2025",
  "💡 Webinaire sur l’innovation durable ce vendredi à 18h",
  "🤝 Partenariat signé avec l’ONG Terre Verte",
  "🌍 Reboisement communautaire à Abidjan ce samedi",
  "📈 Espace collaboratif en ligne pour les membres de WAGEDO",
  "🎓 Nouveau programme d’incubation pour les jeunes entrepreneurs"
];

// Injection dynamique du contenu
document.getElementById("newsMarquee").innerHTML = `<span>${newsList.join(" — ")}</span>`;
</script>

  <!-- ======= Header ======= -->
  <header id="header" class="header headerIndex fixed-top" style="background-color: white;">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <div style="margin-top: 12px;">
          <span>WAGEDO</span>
          <div style="font-size: 11px; text-align: justify; margin-top: 14px; margin-left: 4px; color: black;">
            <div>West African Green Energy</div>
            <div style="margin-top: 12px;">Development Organisation</div>
          </div>
        </div>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.html">Home</a></li>
          <li><a class="nav-link scrollto" href="about.html">About Us</a></li>
          <li class="dropdown megamenu"><a href="#"><span>Areas of action</span> <i
                class="bi bi-chevron-down"></i></a>
            <ul>
              <li>
                <a href="enr.html">Renewable Energy</a>
                <a href="hydrogene_vert.html">Green Hydrogen</a>
              </li>
              <li>
                <a href="education.html">Education</a>
                <a href="sensibilisation_climatique.html">Climate Awareness</a>
              </li>
              <li>
                <a href="transition_energetique.html">Energy Transition</a>
                <a href="protection_environnement.html">Environmental Protection</a>
              </li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="projets.html">Projects / Events</a></li>
          </li>
          <li><a href="blog.html">News / Blog</a></li>
          <!-- <li><a class="nav-link scrollto" href="ressources.html">Ressources</a></li> -->
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="impliquez-vous.html">Get involved</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container" style="background-color: rgba(0, 0, 0, 0.182);">
      <div class="row">
        <!-- <div class="col-lg-8 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up" style="color: #0a7b2b;">Promotion des énergies renouvelables et des énergies propres,</h1>
          <h2 data-aos="fade-up" data-aos-delay="400" style="color: #fff; font-weight: 700;">avec un accent particulier sur des technologies innovantes telles que
            <span style="color: #0a7b2b; font-weight: 700;">l’hydrogène vert.</span></h2>
        </div> -->
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>About Us</h3>
              <h2>West African Green Energy Development Organisation (WAGEDO) </h2>
              <p style="text-align: justify;">
                The West African Green Energy Development Organisation (WAGEDO) is a youth-led organisation founded by
                H2 students of the
                International Program in Energy and Hydrogen at WASCAL, driven by a shared commitment to addressing
                global energy challenges. What
                began as a student initiative has since grown into an officially registered international organisation
                dedicated to tackling pressing
                energy issues, with a particular focus on West Africa.
                Our mission is to build skills, actively participate on the policy making, boost the understanding of
                sustainable development that offers policy
                relevant path to underpin prosperity of clean energy, create jobs and enhances social equity in West
                Africa.
              </p>
              <div class="text-center text-lg-start">
                <a href="about.html"
                  class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Learn more</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-3 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <img src="assets/img/values-1.png" alt="">
              <h3>Renewable Energy and Energy Efficiency</h3>
              <div class="text-center text-lg-start moreBox">
                <a href="#" class="d-inline-flex align-items-center justify-content-center align-self-center">
                  <span style="color: black;">Learn more</span>
                  <i class="bi bi-arrow-right" style="color: black;"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <img src="assets/img/values-2.png" class="img-fluid" alt="">
              <h3>Energy Transition</h3>
              <div class="text-center text-lg-start moreBox">
                <a href="#" class="d-inline-flex align-items-center justify-content-center align-self-center">
                  <span style="color: black;">Learn more</span>
                  <i class="bi bi-arrow-right" style="color: black;"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="assets/img/values-3.png" class="img-fluid" alt="">
              <h3>Education</h3>
              <div class="text-center text-lg-start moreBox">
                <a href="#" class="d-inline-flex align-items-center justify-content-center align-self-center">
                  <span style="color: black;">Learn more</span>
                  <i class="bi bi-arrow-right" style="color: black;"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="800">
            <div class="box">
              <img src="assets/img/values-4.png" class="img-fluid" alt="">
              <h3>Environmental Protection</h3>
              <div class="text-center text-lg-start moreBox">
                <a href="#" class="d-inline-flex align-items-center justify-content-center align-self-center">
                  <span style="color: black;">Learn more</span>
                  <i class="bi bi-arrow-right" style="color: black;"></i>
                </a>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Values Section -->

    <img src="assets/img/4-1.png" alt="" style="width: 100%;">

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>News / Blog</h2>
          <p>Stay up to date with our news and inspiring shares</p>
        </header>

        <div class="row">

          <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt=""></div>
              <span class="post-date">January 2025</span>
              <h3 class="post-title">RENEWABLE ENERGY MONTH - LOME</h3>
              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read more</span><i
                  class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-2.jpg" class="img-fluid" alt=""></div>
              <span class="post-date">February 26, 2025</span>
              <h3 class="post-title">RENEWABLE ENERGY MONTH - ABIDJAN</h3>
              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read more</span><i
                  class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-3.jpg" class="img-fluid" alt=""></div>
              <span class="post-date">January, 2025</span>
              <h3 class="post-title">WAGEDO PARTNERSHIP WITH JAE (Jeune Acteur de l'Énergie)</h3>
              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read more</span><i
                  class="bi bi-arrow-right"></i></a>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Recent Blog Posts Section -->

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <img src="assets/img/values-1.png" alt="">
              <h3>Les Énergies Renouvelables et l'Efficacité Énergétique</h3>
              <div class="text-center text-lg-start moreBox">
                <a href="#" class="d-inline-flex align-items-center justify-content-center align-self-center">
                  <span style="color: black;">S'inscrire</span>
                  <i class="bi bi-arrow-right" style="color: black;"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <img src="assets/img/values-2.png" class="img-fluid" alt="">
              <h3>La transition énergétique</h3>
              <div class="text-center text-lg-start moreBox">
                <a href="#" class="d-inline-flex align-items-center justify-content-center align-self-center">
                  <span style="color: black;">Rejoindre la communauté</span>
                  <i class="bi bi-arrow-right" style="color: black;"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="assets/img/values-3.png" class="img-fluid" alt="">
              <h3>La Sensibilisation climatique</h3>
              <div class="text-center text-lg-start moreBox">
                <a href="#" class="d-inline-flex align-items-center justify-content-center align-self-center">
                  <span style="color: black;">En savoir plus</span>
                  <i class="bi bi-arrow-right" style="color: black;"></i>
                </a>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Values Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Projects / Events</h2>
          <p>Discover our initiatives and projects to be implemented</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-box blue">
              <i class="ri-layout-grid-fill icon"></i>
              <h5>Clean Cooking for All Project (CC4AP)</h3>
                <p>The CC4AP promotes the adoption of improved eco-charcoal stoves to reduce indoor air pollution and deforestation, 
                  while raising awareness among communities about the benefits of sustainable cooking solutions.</p>
                <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-box orange">
              <i class="ri-projector-line icon"></i>
              <h5>Green Hydrogen Online Fellowship (GH-F) </h3>
                <p>The GH-F offers interactive online training courses on green hydrogen technologies
                      and promotes mentoring and networking among participants, experts, and researchers in the sector.</p>
                <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box green">
              <i class="ri-layout-grid-fill icon"></i>
              <h5>Rural Community Solar Electrification Project (RCSEP)</h3>
                <p>The RCSEP aims to deploy solar microgrids in rural areas to ensure access to electricity, 
                  while strengthening local capacities for the sustainable management and maintenance of the installed systems.</p>
                <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-box red">
              <i class="ri-projector-2-fill icon"></i>
              <h5>Clean Water Provision Project (CWaPP)</h3>
                <p>The CWaPP will enable the installation of solar water pumps to ensure sustainable access to drinking water
                      and to conduct hygiene and sanitation awareness campaigns within communities.</p>
                <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
            <div class="service-box pink">
              <i class="ri-projector-line icon"></i>
              <h5>Collaboration and Partnership with International Organisations and NGOs</h5>
              <p>The initiative aims to map energy stakeholders and establish strategic collaborative partnerships.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-box purple">
              <i class="ri-projector-2-fill icon"></i>
              <h5>Seeking funds and collaborations for the implementation our initiatives</h5>
              <p>We are always seeking funding and partnerships to support the effective implementation and
                scaling of our initiatives.</p>
              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Gallery / Multimedia </h2>
          <p>Relive WAGEDO's activities in pictures</p>
        </header>

        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/lome/1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4 style="font-size: 13px;">WAGEDO RENEWABLE ENERGY MONTH LOME</h4>
                <!-- <p>Web</p> -->
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/lome/1.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"
                    title="WAGEDO RENEWABLE ENERGY MONTH LOME"><i class="bi bi-plus"></i></a>
                  <a href="WAGEDO RENEWABLE ENERGY MONTH LOME.html" title="More Details"><i class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/niamey/1.JPG" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4 style="font-size: 13px;">WAGEDO RENEWABLE ENERGY MONTH NIAMEY</h4>
                <!-- <p>Web</p> -->
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/niamey/1.JPG" data-gallery="portfolioGallery" class="portfokio-lightbox"
                    title="WAGEDO RENEWABLE ENERGY MONTH NIAMEY"><i class="bi bi-plus"></i></a>
                  <a href="WAGEDO RENEWABLE ENERGY MONTH NIAMEY.html" title="More Details"><i
                      class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/germany/1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4 style="font-size: 13px;">CAREER AND ENTREPRENEURSHIP WORKSHOP GERMANY</h4>
                <!-- <p>App</p> -->
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/germany/1.jpg" data-gallery="portfolioGallery"
                    class="portfokio-lightbox" title="CAREER AND ENTREPRENEURSHIP WORKSHOP GERMANY"><i
                      class="bi bi-plus"></i></a>
                  <a href="CAREER AND ENTREPRENEURSHIP WORKSHOP GERMANY.html" title="More Details"><i
                      class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/jae/1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4 style="font-size: 13px;">WAGEDO PARTNERSHIP WITH JAE</h4>
                <!-- <p>Card</p> -->
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/jae/1.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"
                    title="WAGEDO PARTNERSHIP WITH JAE"><i class="bi bi-plus"></i></a>
                  <a href="WAGEDO PARTNERSHIP WITH JAE.html" title="More Details"><i class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/abidjan/1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4 style="font-size: 13px;">WAGEDO RENEWABLE ENERGY MONTH ABIDJAN</h4>
                <!-- <p>App</p> -->
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/abidjan/1.jpg" data-gallery="portfolioGallery"
                    class="portfokio-lightbox" title="WAGEDO RENEWABLE ENERGY MONTH ABIDJAN"><i
                      class="bi bi-plus"></i></a>
                  <a href="WAGEDO RENEWABLE ENERGY MONTH ABIDJAN.html" title="More Details"><i
                      class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/DAKAR/1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4 style="font-size: 13px;">WAGEDO RENEWABLE ENERGY MONTH DAKAR</h4>
                <!-- <p>App</p> -->
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/DAKAR/1.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox"
                    title="WAGEDO RENEWABLE ENERGY MONTH DAKAR"><i class="bi bi-plus"></i></a>
                  <a href="WAGEDO RENEWABLE ENERGY MONTH DAKAR.html" title="More Details"><i class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Portfolio Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <!-- <h2>Our Clients</h2> -->
          <p>Key Partners</p>
        </header>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-9.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-10.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

    </section><!-- End Clients Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </header>

        <div class="row">
          <div class="col-lg-6">
            <!-- F.A.Q List 1-->
            <div class="accordion accordion-flush" id="faqlist1">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-1">
                    What is WAGEDO?
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    WAGEDO is an initiative dedicated to promoting projects and events that foster the
                    development of sustainable energy, innovation, and community engagement.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-2">
                    Who can participate in WAGEDO activities?
                  </button>
                </h2>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Our activities are open to everyone: members, partners, volunteers, and anyone interested in our topics.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-3">
                    How can I get involved with WAGEDO?
                  </button>
                </h2>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    You can join our projects as a volunteer, participate in our events, or collaborate as a partner.
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-6">

            <!-- F.A.Q List 2-->
            <div class="accordion accordion-flush" id="faqlist2">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-1">
                    What types of events do you organize?
                  </button>
                </h2>
                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    We offer workshops, conferences, training sessions, and collaborative meetings around our projects and themes.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-2">
                    How can I stay informed about WAGEDO news?
                  </button>
                </h2>
                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    You can follow our website, our mailbox, our blog, and our social media accounts so you don't miss a thing.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-3">
                    Can I submit a project or idea to WAGEDO?
                  </button>
                </h2>
                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Yes, we encourage all constructive suggestions. You can contact us directly via our online form.
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section><!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Adresse</h3>
                  <p><br>Banjul, The Gambia</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Contact Us</h3>
                  <p>+225 05 554 202 17<br>+223 741 864 07</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>www.admin@wagedo.org<br>aboubacarfatoumatacamara99@gmail.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Lundi - Vendredi<br>9:00 - 17:00</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your name" required>
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your e-mail" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject/Object" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you for your attention</div>

                  <button type="submit">Send a message</button>
                </div>

              </div>
            </form>

          </div>

        </div>

      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h4>Our mailbox</h4>
            <p>Get our latest news, projects, and events delivered straight to your inbox.</p>
          </div>
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Souscrire">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/logo.png" alt="">
              <div style="margin-top: 12px;">
                <span style="color: #0a7b2b;">WAGEDO</span>
                <div style="font-size: 11px; text-align: justify; margin-top: 14px; margin-left: 4px; color: black;">
                  <div>West African Green Energy</div>
                  <div style="margin-top: 12px;">Development Organisation</div>
                </div>
              </div>
            </a>
            <p>Hydrogen Green Economy Driver for a Sustainable Future</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Liens utiles</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">About Us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Areas of action</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Projects / Events</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">News / Blog</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Actions</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Contact</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Get Involved</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Make a donation</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Partnership</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              Banjul<br>
              The Gambia <br><br>
              <strong>Tel:</strong> +223 741 864 07<br>
              <strong>Email:</strong> www.admin@wagedo.org<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span style="color: #0a7b2b;">WAGEDO</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
        Designed by <a href="https://ivoirecodingcenter.com/" style="color: #0a7b2cbd;">Ivoire Coding Center</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>