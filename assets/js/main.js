/**
* Template Name: FlexStart
* Updated: Sep 18 2023 with Bootstrap v5.3.2
* Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e?.addEventListener(type, listener))
    } else {
      select(el, all)?.addEventListener(type, listener)
    }
  }

  window.addEventListener("scroll", function () {
  const header = document.querySelector(".headerIndex");
if (header) {
    if (window.scrollY > 45) {
    header.style.top = "0px";
  } else {
    header.style.top = "36px";
  }
}

});


  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 10
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Clients Slider
   */
  new Swiper('.clients-slider', {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      320: {
        slidesPerView: 2,
        spaceBetween: 40
      },
      480: {
        slidesPerView: 3,
        spaceBetween: 60
      },
      640: {
        slidesPerView: 4,
        spaceBetween: 80
      },
      992: {
        slidesPerView: 6,
        spaceBetween: 120
      }
    }
  });

  /**
   * Porfolio isotope and filter
   */
  window.addEventListener('load', () => {
    let portfolioContainer = select('.portfolio-container');
    if (portfolioContainer) {
      let portfolioIsotope = new Isotope(portfolioContainer, {
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
      });

      let portfolioFilters = select('#portfolio-flters li', true);

      on('click', '#portfolio-flters li', function(e) {
        e.preventDefault();
        portfolioFilters.forEach(function(el) {
          el.classList.remove('filter-active');
        });
        this.classList.add('filter-active');

        portfolioIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        aos_init();
      }, true);
    }

  });

  /**
   * Initiate portfolio lightbox 
   */
  const portfolioLightbox = GLightbox({
    selector: '.portfokio-lightbox'
  });

  /**
   * Portfolio details slider
   */
  new Swiper('.portfolio-details-slider', {
    speed: 400,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });

  /**
   * Testimonials slider
   */
  new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 40
      },

      1200: {
        slidesPerView: 3,
      }
    }
  });

  /**
  * Animation on scroll
  */
  function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', () => {
    aos_init();
  });

  /**
   * Initiate Pure Counter 
   */
  new PureCounter();

// Connexion page administration
const formConnexion = document.querySelector('#connexionPage');
if (formConnexion) {
  formConnexion.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(formConnexion);
    const params = new URLSearchParams(formData).toString();

    const loading = document.querySelector('.loadingBoutonConnexion');
    const envoyerForm = document.querySelector('.envoyerFormConnexion');
    const responseContainer = document.querySelector('.responseConnexion');

    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'connexionPage=' + decodeURIComponent(params),
      });
      const data = await response.text();

      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainer.innerHTML = data;
      responseContainer.style.display = 'initial';
    } catch (error) {
      console.error('Erreur de connexion :', error);
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainer.innerHTML = "<p>Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';
    }
  });
}

// faire un don
const submitFaireDon = document.querySelector('#submitFaireDon');
if (submitFaireDon) {
  submitFaireDon.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(submitFaireDon);
    
    const params = new URLSearchParams(formData).toString();
// console.log("params", params)
    const loading = document.querySelector('.loadingBoutonForm');
    const envoyerForm = document.querySelector('.submitFaireDon');
    const responseContainer = document.querySelector('.responseForm');
    const responseContainerSuccess = document.querySelector('.responseFormSuccess');

    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: decodeURIComponent(params),
      });
      const data = await response.text();

      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainerSuccess.innerHTML = data;
      responseContainerSuccess.style.display = 'initial';
    } catch (error) {
      console.error('Erreur de connexion :', error);
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainer.innerHTML = "<p>Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';
    }
  });
}

// Rejoindre wagedo
const submitRejoindreWagedo = document.querySelector('#submitRejoindreWagedo');
if (submitRejoindreWagedo) {
  submitRejoindreWagedo.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(submitRejoindreWagedo);
    
    const params = new URLSearchParams(formData).toString();

    const loading = document.querySelector('.loadingBoutonForm');
    const envoyerForm = document.querySelector('.submitRejoindreWagedo');
    const responseContainer = document.querySelector('.responseForm');
    const responseContainerSuccess = document.querySelector('.responseFormSuccess');

    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: decodeURIComponent(params),
      });
      const data = await response.text();

      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainerSuccess.innerHTML = data;
      responseContainerSuccess.style.display = 'initial';
    } catch (error) {
      console.error('Erreur de connexion :', error);
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainer.innerHTML = "<p>Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';
    }
  });
}

// Demande de partenariat
const submitFormPartenariat = document.querySelector('#submitFormPartenariat');
if (submitFormPartenariat) {
  submitFormPartenariat.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(submitFormPartenariat);
    
    const params = new URLSearchParams(formData).toString();

    const loading = document.querySelector('.loadingBoutonForm');
    const envoyerForm = document.querySelector('.submitFormPartenariat');
    const responseContainer = document.querySelector('.responseForm');
    const responseContainerSuccess = document.querySelector('.responseFormSuccess');

    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: decodeURIComponent(params),
      });
      const data = await response.text();

      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainerSuccess.innerHTML = data;
      responseContainerSuccess.style.display = 'initial';
    } catch (error) {
      console.error('Erreur de connexion :', error);
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainer.innerHTML = "<p>Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';
    }
  });
}

//  Message des visiteurs
const submitFormMessageVisiteur = document.querySelector('#submitFormMessageVisiteur');
if (submitFormMessageVisiteur) {
  submitFormMessageVisiteur.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(submitFormMessageVisiteur);
    
    const params = new URLSearchParams(formData).toString();

    const loading = document.querySelector('.loadingBoutonForm');
    const envoyerForm = document.querySelector('.submitFormMessageVisiteur');
    const responseContainer = document.querySelector('.responseForm');
    const responseContainerSuccess = document.querySelector('.responseFormSuccess');

    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: decodeURIComponent(params),
      });
      const data = await response.text();

      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainerSuccess.innerHTML = data;
      responseContainerSuccess.style.display = 'initial';
    } catch (error) {
      console.error('Erreur de connexion :', error);
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainer.innerHTML = "<p>Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';
    }
  });
}


// ajouter actualités
const submitFormNewActualite = document.querySelector('#submitFormNewActualite');
if (submitFormNewActualite) {
  submitFormNewActualite.addEventListener('submit', async (e) => {
    e.preventDefault();
 // ⚡ Important : synchroniser TinyMCE avec le <textarea>
  tinymce.triggerSave();
    const formData = new FormData(submitFormNewActualite);

    const loading = document.querySelector('.loadingBoutonForm');
    const envoyerForm = document.querySelector('.submitFormNewActualite');
    const responseContainer = document.querySelector('.responseForm');
    const responseContainerSuccess = document.querySelector('.responseFormSuccess');

    // Loader visible
    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        body: formData,
      });

      const data = await response.text();

      // Cacher le loader
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');

      // Afficher la réponse succès
      responseContainerSuccess.innerHTML = data;
      responseContainerSuccess.style.display = 'initial';

      // ✅ Réinitialiser le formulaire après succès
      submitFormNewActualite.reset();

      // vider TinyMCE aussi
    tinymce.get('contenu').setContent('');

      // ✅ Si tu as un conteneur d'aperçu d’images (prévisualisation)
      const previewContainer = document.getElementById('preview-container');
      if (previewContainer) previewContainer.innerHTML = '';

      // ✅ Réafficher le bouton d’envoi
      envoyerForm.classList.remove('containerDisplayNone');

      // ✅ Masquer le message succès après quelques secondes (optionnel)
      setTimeout(() => {
        responseContainerSuccess.style.display = 'none';
        responseContainerSuccess.innerHTML = '';
      }, 4000);

    } catch (error) {
      console.error('Erreur de connexion :', error);

      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');

      responseContainer.innerHTML = "<p>❌ Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';

      // Réafficher le bouton
      envoyerForm.classList.remove('containerDisplayNone');
    }
  });
}

// inscription au newsletters
const submitFormNewsletter = document.querySelector('#submitFormNewsletter');
if (submitFormNewsletter) {
  submitFormNewsletter.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(submitFormNewsletter);
    
    const params = new URLSearchParams(formData).toString();

    const loading = document.querySelector('.loadingBoutonFormNews');
    const envoyerForm = document.querySelector('.submitFormNewsletter');
    const responseContainer = document.querySelector('.responseFormNews');
    const responseContainerSuccess = document.querySelector('.responseFormSuccessNews');

    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: decodeURIComponent(params),
      });
      const data = await response.text();
console.log("params", params)
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainerSuccess.innerHTML = data;
      responseContainerSuccess.style.display = 'initial';
    } catch (error) {
      console.error('Erreur de connexion :', error);
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');
      responseContainer.innerHTML = "<p>Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';
    }
  });
}

// const submitFormNewOpportunity = document.querySelector('#submitFormNewOpportunity');
// if (submitFormNewOpportunity) {
//   submitFormNewOpportunity.addEventListener('submit', async (e) => {
//     e.preventDefault();
//  // ⚡ Important : synchroniser TinyMCE avec le <textarea>
//   tinymce.triggerSave();
//     const formData = new FormData(submitFormNewOpportunity);

//     const loading = document.querySelector('.loadingBoutonForm');
//     const envoyerForm = document.querySelector('.submitFormNewOpportunity');
//     const responseContainer = document.querySelector('.responseForm');
//     const responseContainerSuccess = document.querySelector('.responseFormSuccess');

//     // Loader visible
//     loading.classList.remove('containerDisplayNone');
//     loading.classList.add('containerDisplayInitial');
//     envoyerForm.classList.add('containerDisplayNone');

//     try {
//       const response = await fetch('back_data.php', {
//         method: 'POST',
//         body: formData,
//       });

//       const data = await response.text();

//       // Cacher le loader
//       loading.classList.remove('containerDisplayInitial');
//       loading.classList.add('containerDisplayNone');

//       // Afficher la réponse succès
//       responseContainerSuccess.innerHTML = data;
//       responseContainerSuccess.style.display = 'initial';

//       // ✅ Réinitialiser le formulaire après succès
//       submitFormNewOpportunity.reset();

//       // vider TinyMCE aussi
//     tinymce.get('contenu').setContent('');

//       // ✅ Si tu as un conteneur d'aperçu d’images (prévisualisation)
//       const previewContainer = document.getElementById('preview-container');
//       if (previewContainer) previewContainer.innerHTML = '';

//       // ✅ Réafficher le bouton d’envoi
//       envoyerForm.classList.remove('containerDisplayNone');

//       // ✅ Masquer le message succès après quelques secondes (optionnel)
//       setTimeout(() => {
//         responseContainerSuccess.style.display = 'none';
//         responseContainerSuccess.innerHTML = '';
//       }, 4000);

//     } catch (error) {
//       console.error('Erreur de connexion :', error);

//       loading.classList.remove('containerDisplayInitial');
//       loading.classList.add('containerDisplayNone');

//       responseContainer.innerHTML = "<p>❌ Erreur de connexion au serveur.</p>";
//       responseContainer.style.display = 'initial';

//       // Réafficher le bouton
//       envoyerForm.classList.remove('containerDisplayNone');
//     }
//   });
// }

// ajouter actualités
const submitFormNewOpportunity = document.querySelector('#submitFormNewOpportunity');
if (submitFormNewOpportunity) {
  submitFormNewOpportunity.addEventListener('submit', async (e) => {
    e.preventDefault();
 // ⚡ Important : synchroniser TinyMCE avec le <textarea>
  tinymce.triggerSave();
    const formData = new FormData(submitFormNewOpportunity);

    const loading = document.querySelector('.loadingBoutonForm');
    const envoyerForm = document.querySelector('.submitFormNewOpportunity');
    const responseContainer = document.querySelector('.responseForm');
    const responseContainerSuccess = document.querySelector('.responseFormSuccess');

    // Loader visible
    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        body: formData,
      });

      const data = await response.text();

      // Cacher le loader
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');

      // Afficher la réponse succès
      responseContainerSuccess.innerHTML = data;
      responseContainerSuccess.style.display = 'initial';

      // ✅ Réinitialiser le formulaire après succès
      submitFormNewOpportunity.reset();

      // vider TinyMCE aussi
    tinymce.get('contenu').setContent('');

      // ✅ Si tu as un conteneur d'aperçu d’images (prévisualisation)
      const previewContainer = document.getElementById('preview-container');
      if (previewContainer) previewContainer.innerHTML = '';

      // ✅ Réafficher le bouton d’envoi
      envoyerForm.classList.remove('containerDisplayNone');

      // ✅ Masquer le message succès après quelques secondes (optionnel)
      setTimeout(() => {
        responseContainerSuccess.style.display = 'none';
        responseContainerSuccess.innerHTML = '';
      }, 4000);

    } catch (error) {
      console.error('Erreur de connexion :', error);

      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');

      responseContainer.innerHTML = "<p>❌ Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';

      // Réafficher le bouton
      envoyerForm.classList.remove('containerDisplayNone');
    }
  });
}

const submitFormNewALaUne = document.querySelector('#submitFormNewALaUne');
if (submitFormNewALaUne) {
  submitFormNewALaUne.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(submitFormNewALaUne);

    const loading = document.querySelector('.loadingBoutonForm');
    const envoyerForm = document.querySelector('.submitFormNewALaUne');
    const responseContainer = document.querySelector('.responseForm');
    const responseContainerSuccess = document.querySelector('.responseFormSuccess');

    // Loader visible
    loading.classList.remove('containerDisplayNone');
    loading.classList.add('containerDisplayInitial');
    envoyerForm.classList.add('containerDisplayNone');

    try {
      const response = await fetch('back_data.php', {
        method: 'POST',
        body: formData,
      });

      const data = await response.text();

      // Cacher le loader
      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');

      // Afficher la réponse succès
      responseContainerSuccess.innerHTML = data;
      responseContainerSuccess.style.display = 'initial';

      // ✅ Réinitialiser le formulaire après succès
      submitFormNewALaUne.reset();


      // ✅ Si tu as un conteneur d'aperçu d’images (prévisualisation)
      const previewContainer = document.getElementById('preview-container');
      if (previewContainer) previewContainer.innerHTML = '';

      // ✅ Réafficher le bouton d’envoi
      envoyerForm.classList.remove('containerDisplayNone');

      // ✅ Masquer le message succès après quelques secondes (optionnel)
      setTimeout(() => {
        responseContainerSuccess.style.display = 'none';
        responseContainerSuccess.innerHTML = '';
      }, 4000);

    } catch (error) {
      console.error('Erreur de connexion :', error);

      loading.classList.remove('containerDisplayInitial');
      loading.classList.add('containerDisplayNone');

      responseContainer.innerHTML = "<p>❌ Erreur de connexion au serveur.</p>";
      responseContainer.style.display = 'initial';

      // Réafficher le bouton
      envoyerForm.classList.remove('containerDisplayNone');
    }
  });
}

})();