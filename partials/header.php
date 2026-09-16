<div class="band" aria-hidden="true"><span class="b1"></span><span class="b2"></span><span class="b3"></span><span class="b4"></span></div>

<header>
  <div class="wrap nav">
    <a class="brand" href="./" aria-label="Medware Solutions home">
      <img class="brand-logo" src="assets/images/logo/medware_logo.png" alt="MedWare Solutions Limited">
    </a>
    <button class="menu-btn" aria-label="Open menu" aria-expanded="false" onclick="toggleMenu(this)">
      <span></span><span></span><span></span>
    </button>
    <nav class="links" id="menu">
      <a href="./">Home</a>
      <div class="nav-item">
        <a href="products">Products</a>
        <div class="dropdown">
          <a href="healthcare-ict">Healthcare ICT</a>
          <a href="medical-gas-systems">Medical Gas Systems</a>
        </div>
      </div>
      <div class="nav-item">
        <a href="services">Services</a>
        <div class="dropdown">
          <a href="services#infrastructure">Healthcare Infrastructure Development</a>
          <a href="services#biomedical">Biomedical Engineering Services</a>
          <a href="services#ict">Healthcare ICT</a>
        </div>
      </div>
      <div class="nav-item">
        <a href="projects">Projects</a>
        <div class="dropdown">
          <a href="projects#infrastructure">Healthcare Infrastructure Development</a>
          <a href="projects#biomedical">Biomedical Engineering</a>
          <a href="projects#ict">Healthcare ICT</a>
        </div>
      </div>
      <a href="partners">Partners</a>
      <a href="about">About Us</a>
      <a href="blog">Blog</a>
      <a href="contact">Contact</a>
      <a class="btn" href="contact">Request a consultation</a>
    </nav>
  </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll('.links > a, .links .nav-item > a');
        
        function updateActiveLink() {
            links.forEach(l => l.classList.remove('active'));
            
            let path = window.location.pathname.split('/').pop().replace('.php', '');
            if (path === '' || path === 'www.medwaresolutions.com') path = 'index'; // Handle root
            const hash = window.location.hash;
            
            let activeSet = false;

            // 1. Check exact matches with hashes (e.g., index#about)
            if (hash) {
                const exactHashMatch = Array.from(links).find(l => l.getAttribute('href') === (path + hash) || l.getAttribute('href') === ('./' + hash) || l.getAttribute('href') === ('index' + hash));
                if (exactHashMatch) {
                    exactHashMatch.classList.add('active');
                    activeSet = true;
                }
            }

            // 2. Check path categories if no hash matched
            if (!activeSet) {
                if (['products', 'healthcare-ict', 'medical-gas-systems', 'medical-gas-pipeline-components', 'vacuum-medical-air-plants', 'oxygen-generating-plants', 'pneumatic-tube-systems', 'fire-alarm-systems', 'queue-management-kiosks', 'bms-hardware', 'medware-cmms', 'visocall-ip-nurse-call'].includes(path)) {
                    const prodLink = Array.from(links).find(l => l.getAttribute('href') === 'products');
                    if (prodLink) prodLink.classList.add('active');
                } else if (path.includes('project')) {
                    const projLink = Array.from(links).find(l => l.getAttribute('href') === 'projects');
                    if (projLink) projLink.classList.add('active');
                } else if (path.includes('blog')) {
                    const blogLink = Array.from(links).find(l => l.getAttribute('href') === 'blog');
                    if (blogLink) blogLink.classList.add('active');
                } else if (path.includes('service')) {
                    const servLink = Array.from(links).find(l => l.getAttribute('href') === 'services');
                    if (servLink) servLink.classList.add('active');
                } else if (path === 'contact') {
                    const cLink = Array.from(links).find(l => l.getAttribute('href') === 'contact');
                    if (cLink) cLink.classList.add('active');
                } else if (path === 'about') {
                    const aLink = Array.from(links).find(l => l.getAttribute('href') === 'about');
                    if (aLink) aLink.classList.add('active');
                } else if (path === 'partners') {
                    const pLink = Array.from(links).find(l => l.getAttribute('href') === 'partners');
                    if (pLink) pLink.classList.add('active');
                } else if (path === 'index') {
                    const homeLink = Array.from(links).find(l => l.getAttribute('href') === './' || l.getAttribute('href') === 'index');
                    if (homeLink) homeLink.classList.add('active');
                }
            }
        }

        // Run on page load
        updateActiveLink();

        // Update when user clicks an anchor link within the same page
        window.addEventListener('hashchange', updateActiveLink);
        
        // Also update immediately on click for instant feedback
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.getAttribute('href').includes('#')) {
                    setTimeout(updateActiveLink, 50); // allow hash to update
                }
            });
        });
    });
    </script>
</header>






