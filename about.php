<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Medware Solutions Ltd — Healthcare Infrastructure Development, Biomedical Engineering &amp; Healthcare ICT</title>
<meta name="description" content="Medware Solutions Ltd delivers healthcare infrastructure development, biomedical engineering services and healthcare ICT for hospitals across Kenya and East Africa.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet">
<style>
:root{
  --blue:#1B75BC;         /* Medware primary blue */
  --blue-d:#0F5A99;
  --navy:#28316E;         /* profile panel navy */
  --sky:#5FA8DC;
  --grey:#6D6E71;         /* profile grey */
  --ink:#2C3038;
  --bg:#F4F6F9;
  --panel:#FFFFFF;
  --line:#DCE3EC;
  --radius:10px;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
@media (prefers-reduced-motion: reduce){
  html{scroll-behavior:auto}
  *,*::before,*::after{animation:none!important;transition:none!important}
}
body{font-family:"Inter",system-ui,sans-serif;background:var(--bg);color:var(--ink);line-height:1.65;font-size:16.5px}
h1,h2,h3,h4{font-family:"Montserrat",sans-serif;line-height:1.15;color:var(--navy)}
h1 em,h2 em,h3 em{font-style:normal;color:var(--blue)}
.kicker{font-family:"Montserrat",sans-serif;font-weight:700;font-size:.74rem;letter-spacing:.16em;text-transform:uppercase;color:var(--blue)}
.wrap{width:90%;max-width:1140px;margin:0 auto}
a{color:inherit}
img{max-width:100%;display:block}

/* top band — brand blues */
.band{display:flex;height:5px;width:100%}
.band span{flex:1}
.band .b1{background:var(--blue)}
.band .b2{background:var(--navy)}
.band .b3{background:var(--sky)}
.band .b4{background:var(--grey)}

/* header */
header{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.94);backdrop-filter:blur(10px);border-bottom:1px solid var(--line)}
.nav{display:flex;align-items:center;justify-content:space-between;height:96px}
.brand{display:flex;align-items:center;gap:12px;text-decoration:none}
.brand-logo{height:80px;width:auto;display:block}
nav.links{display:flex;gap:26px;align-items:center}
nav.links a{text-decoration:none;font-size:.92rem;font-weight:700;color:var(--ink);padding:6px 0;border-bottom:2px solid transparent;transition:border-color .18s,color .18s}
nav.links a:hover,nav.links a.active{color:var(--blue);border-bottom-color:var(--blue)}
nav.links .btn{font-weight:700;padding:11px 22px}
.btn{display:inline-block;background:var(--blue);color:#fff;text-decoration:none;font-weight:600;font-size:.92rem;padding:11px 22px;border-radius:8px;transition:background .18s,transform .18s}
.btn:hover{background:var(--blue-d);transform:translateY(-1px)}
.btn.ghost{background:transparent;color:var(--blue);border:1.5px solid var(--blue)}
.btn.ghost:hover{background:var(--blue);color:#fff}
.menu-btn{display:none;background:none;border:0;cursor:pointer;padding:8px}
.menu-btn span{display:block;width:22px;height:2px;background:var(--navy);margin:5px 0;border-radius:2px}

.nav-item{position:relative;display:flex;align-items:center}
.nav-item>a{display:inline-flex;align-items:center}
.dropdown{position:absolute;top:100%;left:50%;transform:translateX(-50%);background:#fff;border:1px solid var(--line);border-radius:10px;box-shadow:0 20px 44px -20px rgba(15,90,153,.35);padding:8px;min-width:250px;opacity:0;visibility:hidden;pointer-events:none;transition:opacity .15s ease;z-index:60}
.nav-item:hover .dropdown,.nav-item:focus-within .dropdown{opacity:1;visibility:visible;pointer-events:auto}
nav.links .dropdown a{display:block;padding:9px 12px;border-radius:6px;font-size:.86rem;font-weight:600;color:var(--ink);border-bottom:0}
nav.links .dropdown a:hover{background:rgba(27,117,188,.1);color:var(--blue);border-bottom:0}

/* hero */
.hero{padding:130px 0 76px;position:relative;overflow:hidden;color:#fff;background:linear-gradient(120deg,rgba(40,49,110,.86),rgba(27,117,188,.8)),url('assets/images/hero_1.jpeg') center/cover no-repeat}
.hero .wrap{position:relative}
.hero-top{max-width:760px}
.hero h1{color:#fff;font-size:clamp(2.2rem,5.2vw,3.8rem);font-weight:800;letter-spacing:-.02em;max-width:16ch}
.hero p.lede{max-width:600px;margin:24px 0 32px;font-size:1.12rem;color:#E3ECFA}
.hero .kicker{display:block;margin-bottom:16px;color:#EAF3FF;text-shadow:0 1px 4px rgba(0,0,0,.35);font-family:"Inter",sans-serif;font-weight:600;letter-spacing:.08em}
.hero-cta{display:flex;gap:14px;flex-wrap:wrap}
.hero-cta .btn.ghost{color:#fff;border-color:rgba(255,255,255,.75)}
.hero-cta .btn.ghost:hover{background:#fff;color:var(--blue-d);border-color:#fff}
.hero-meta{margin-top:56px;display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid rgba(255,255,255,.25)}
.hero-meta div{padding:20px 20px 4px;border-left:1px solid rgba(255,255,255,.25)}
.hero-meta div:first-child{border-left:0;padding-left:0}
.hero-meta span{font-family:"Inter",sans-serif;font-size:.74rem;letter-spacing:.08em;text-transform:uppercase;color:#E8F1FF;font-weight:600;text-shadow:0 1px 4px rgba(0,0,0,.35)}
.hero-meta strong{display:block;font-family:"Montserrat",sans-serif;font-weight:700;font-size:1.05rem;color:#fff;margin-top:4px}

/* sections */
section{padding:80px 0}
.sec-head{max-width:680px;margin-bottom:48px}
.sec-head .kicker{display:inline-flex;align-items:center;gap:10px;margin-bottom:14px}
.sec-head .kicker::before{content:"";width:26px;height:3px;background:var(--blue);display:inline-block}
.sec-head h2{font-size:clamp(1.7rem,3.4vw,2.4rem);font-weight:800;letter-spacing:-.015em}
.sec-head p{margin-top:14px;color:var(--grey)}

/* service blocks */
#services{background:#fff;border-top:1px solid var(--line);border-bottom:1px solid var(--line)}
.svc{border:1px solid var(--line);border-radius:var(--radius);background:var(--bg);padding:34px;margin-bottom:26px}
.svc-media{border-radius:8px;overflow:hidden;margin-bottom:22px}
.svc-media img{width:100%;height:190px;object-fit:cover;display:block}
.svc-top{display:flex;justify-content:space-between;gap:20px;flex-wrap:wrap;align-items:baseline;margin-bottom:8px}
.svc h3{font-size:1.4rem;font-weight:800}
.svc .num{font-family:"Montserrat",sans-serif;font-weight:800;color:var(--blue);opacity:.35;font-size:1.6rem}
.svc>p{color:var(--grey);max-width:66ch}
.svc-list{margin-top:18px;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:10px 24px;list-style:none}
.svc-list li{position:relative;padding-left:22px;font-size:.95rem;font-weight:500}
.svc-list li::before{content:"✓";position:absolute;left:0;top:0;color:var(--blue);font-weight:700}
.partners{margin-top:18px;font-size:.86rem;color:var(--grey)}
.partners b{color:var(--navy);font-weight:600}
.proj-preview{margin-top:22px;padding-top:18px;border-top:1px dashed var(--line);display:flex;flex-wrap:wrap;gap:10px;align-items:center}
.proj-preview .kicker{font-size:.68rem;margin-right:4px}
.chip{background:#fff;border:1px solid var(--line);border-radius:999px;padding:6px 14px;font-size:.85rem;font-weight:500;text-decoration:none;transition:border-color .15s,color .15s}
.chip:hover{border-color:var(--blue);color:var(--blue)}
.chip.more{background:var(--blue);border-color:var(--blue);color:#fff;font-weight:600}
.chip.more:hover{background:var(--blue-d)}

/* navy strip */
.strip{background:var(--navy);color:#DCE6F5;padding:36px 0}
.strip .wrap{display:flex;flex-wrap:wrap;gap:16px 44px;align-items:center;justify-content:space-between}
.strip .kicker{color:var(--sky)}
.strip ul{display:flex;flex-wrap:wrap;gap:12px 32px;list-style:none}
.strip li{font-size:.9rem;font-weight:500;display:flex;align-items:center;gap:9px}
.strip li::before{content:"";width:8px;height:8px;border-radius:50%;background:var(--sky)}

/* about */
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:26px;margin-bottom:26px}
.mv{border-radius:var(--radius);padding:32px;color:#fff;position:relative;overflow:hidden}
.mv.mission{background:var(--blue)}
.mv.vision{background:var(--navy)}
.mv .kicker{color:rgba(255,255,255,.75);display:block;margin-bottom:12px}
.mv p{font-family:"Montserrat",sans-serif;font-weight:600;font-size:1.06rem;line-height:1.5}
.why{list-style:none;display:grid;grid-template-columns:1fr 1fr;gap:0 44px}
.why li{padding:18px 0;border-bottom:1px solid var(--line)}
.why h4{font-size:1rem;font-weight:700;color:var(--blue);margin-bottom:4px}
.why p{font-size:.94rem;color:var(--grey)}
.overview{color:var(--grey);max-width:78ch;margin-bottom:34px}
.overview b{color:var(--ink)}

/* contact */
#contact{background:#fff;border-top:1px solid var(--line)}
.contact-lede{margin-bottom:40px}
.contact-grid{display:grid;grid-template-columns:1.3fr 1fr;gap:40px;align-items:stretch}
.c-card{border:1px solid var(--line);border-radius:var(--radius);padding:26px;background:var(--bg)}
.c-card .kicker{display:block;margin-bottom:8px;font-size:.68rem;color:var(--ink)}
.c-card p,.c-card a{font-size:1.02rem;text-decoration:none}
.c-card a{font-weight:600;color:var(--blue)}
.c-card a:hover{color:var(--navy)}
.hours{width:100%;border-collapse:collapse}
.hours td{padding:8px 0;border-bottom:1px dashed var(--line);font-size:.96rem}
.hours td:first-child{color:var(--ink)}
.hours td:last-child{text-align:right;color:var(--grey)}
.hours tr:last-child td{border-bottom:0}
.c-field + .c-field{margin-top:22px;padding-top:22px;border-top:1px dashed var(--line)}
.map-embed{border-radius:var(--radius);overflow:hidden;border:1px solid var(--line);min-height:320px}
.map-embed iframe{display:block;width:100%;height:100%;min-height:320px}
.contact-lede h2{font-size:clamp(1.7rem,3.2vw,2.3rem);font-weight:800;letter-spacing:-.015em}
.contact-lede p{margin:16px 0 28px;color:var(--grey);max-width:48ch}

.c-form{width:50%;margin:0 auto 24px 0}
.c-form h3{font-size:1.15rem;font-weight:800;margin-bottom:18px}
.c-form label{display:block;font-size:.82rem;font-weight:600;color:var(--ink);margin-bottom:6px}
.c-form-row{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px}
.c-form-field{margin-bottom:18px}
.c-form input,.c-form textarea{width:100%;font-family:inherit;font-size:.95rem;color:var(--ink);background:#fff;border:1px solid var(--line);border-radius:8px;padding:11px 13px;transition:border-color .15s}
.c-form input:focus,.c-form textarea:focus{outline:none;border-color:var(--blue)}
.c-form textarea{resize:vertical;min-height:120px}
.c-form button{display:block;margin:0 auto;border:0;cursor:pointer;font-family:inherit}
.c-form-note{margin-top:12px;font-size:.82rem;color:var(--grey);text-align:center}


/* footer */
footer{background:var(--navy);color:#AEBBDF;padding:34px 0}
footer .wrap{display:flex;flex-wrap:wrap;gap:16px;justify-content:space-between;align-items:center}
footer .f-brand{display:inline-flex;background:#fff;border-radius:8px;padding:10px 16px}
footer .f-brand img{height:52px;width:auto;display:block}
footer p{font-size:.88rem}
footer nav{display:flex;gap:22px}
footer nav a{text-decoration:none;font-size:.88rem;color:#D2DCF2}
footer nav a:hover{color:#fff}

.reveal{opacity:0;transform:translateY(16px);transition:opacity .6s ease,transform .6s ease}
.reveal.in{opacity:1;transform:none}
:focus-visible{outline:3px solid var(--sky);outline-offset:2px;border-radius:4px}

@media (max-width:920px){
  .about-grid,.contact-grid{grid-template-columns:1fr}
  .map-embed{min-height:260px}
  .why{grid-template-columns:1fr}
  .c-form{width:100%}
}
@media (max-width:760px){
  nav.links{display:none;position:absolute;top:96px;left:0;right:0;background:#fff;border-bottom:1px solid var(--line);flex-direction:column;padding:18px 24px;gap:16px;align-items:flex-start}
  nav.links.open{display:flex}
  .nav-item{flex-direction:column;align-items:flex-start;width:100%}
  .dropdown{position:static;opacity:1;visibility:visible;pointer-events:auto;transform:none;box-shadow:none;border:0;background:transparent;padding:2px 0 0 14px;margin:0;min-width:0}
  nav.links .dropdown a{padding:6px 0;font-size:.85rem;font-weight:600;color:var(--grey)}
  .menu-btn{display:block}
  .hero{padding:88px 0 44px}
  .hero-meta{grid-template-columns:1fr}
  .hero-meta div{border-left:0;padding:14px 0 0;border-top:1px solid rgba(255,255,255,.25)}
  section,.disc{padding:56px 0}
  .svc{padding:24px}
  .scope{grid-template-columns:1fr}
  .c-form-row{grid-template-columns:1fr}
}

/* partners marquees */
#partners{background:#fff;border-bottom:1px solid var(--line);padding:70px 0 60px}
.marquee-group{margin-bottom:34px}
.marquee-label{display:flex;align-items:center;gap:12px;margin-bottom:16px}
.marquee-label .kicker{font-size:.72rem}
.marquee-label::after{content:"";flex:1;height:1px;background:var(--line)}
.marquee{position:relative;overflow:hidden;--gap:18px}
.marquee::before,.marquee::after{content:"";position:absolute;top:0;bottom:0;width:70px;z-index:2;pointer-events:none}
.marquee::before{left:0;background:linear-gradient(90deg,#fff,transparent)}
.marquee::after{right:0;background:linear-gradient(270deg,#fff,transparent)}
.marquee-track{display:flex;gap:var(--gap);width:max-content;animation:slide-ltr 38s linear infinite}
.marquee.slow .marquee-track{animation-duration:30s}
.marquee:hover .marquee-track{animation-play-state:paused}
@keyframes slide-ltr{from{transform:translateX(-50%)}to{transform:translateX(0)}}
.logo-badge{display:flex;align-items:center;gap:12px;background:var(--bg);border:1px solid var(--line);border-radius:10px;padding:12px 20px 12px 12px;white-space:nowrap;flex:none}
.logo-badge .tile{width:63px;height:63px;border-radius:12px;background:#fff;border:1px solid var(--line);padding:8px;object-fit:contain;flex:none}
.logo-badge b{font-family:"Montserrat",sans-serif;font-weight:700;font-size:.95rem;color:var(--navy);display:block;line-height:1.2}
.logo-badge small{display:block;font-size:.72rem;color:var(--grey);letter-spacing:.02em}
@media (prefers-reduced-motion: reduce){
  .marquee-track{animation:none!important;flex-wrap:wrap;width:auto}
  .marquee-track .dup{display:none}
  .marquee::before,.marquee::after{display:none}
}

</style>
<link rel="stylesheet" href="assets/css/motion.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<main id="top">
<section id="about">
    <div class="wrap">
      <div class="sec-head reveal">
        <span class="kicker">About Us</span>
        <h2>Company <em>overview</em></h2>
      </div>
      <p class="overview reveal">Our commitment to precision and our adaptability in meeting client needs have established us as <b>the most dependable biomedical engineering service provider in Kenya</b>. Well-defined project management procedures ensure professional conduct, comprehensive record-keeping and on-time project completion — ensuring efficient performance of hospital equipment, minimizing interruptions, and expertly managing technology to improve healthcare.</p>

      <div class="about-grid">
        <div class="mv mission reveal">
          <span class="kicker">Our mission</span>
          <p>Become a leading biomedical equipment and services provider in the region by proactively adapting to the evolving healthcare landscape — prioritizing top-quality products, high-integrity professionals and strong partnerships, on the way to market leadership in healthcare technology solutions.</p>
        </div>
        <div class="mv vision reveal">
          <span class="kicker">Our vision</span>
          <p>To be the leading and most trusted provider of biomedical engineering solutions in the region — driving excellence in healthcare delivery and contributing to healthier, better lives.</p>
        </div>
      </div>

      <ul class="why">
        <li class="reveal"><h4>Unique qualifications</h4><p>Deep knowledge of healthcare infrastructure and biomedical engineering.</p></li>
        <li class="reveal"><h4>Quality and reliability</h4><p>Reputable manufacturers, with maintenance and reliability assurance.</p></li>
        <li class="reveal"><h4>Specialized expertise</h4><p>Best global practices with local expertise and tailored solutions.</p></li>
        <li class="reveal"><h4>Customer-centric approach</h4><p>Personalized attention, ongoing support and proven success with positive client testimonials.</p></li>
        <li class="reveal"><h4>Comprehensive range of services</h4><p>Streamlined integrations and end-to-end solutions incorporating cutting-edge technologies.</p></li>
        <li class="reveal"><h4>Regulatory compliance</h4><p>Meeting industry standards and regulations at every stage.</p></li>
      </ul>
    </div>
  </section>
</main>


<?php include 'partials/footer.php'; ?>

<script src="assets/js/motion.js" defer=""></script>
<script>
document.getElementById('contact-form').addEventListener('submit',e=>{
  e.preventDefault();
  const name=document.getElementById('cf-name').value;
  const email=document.getElementById('cf-email').value;
  const phone=document.getElementById('cf-phone').value;
  const message=document.getElementById('cf-message').value;
  const subject=encodeURIComponent(`Website enquiry from ${name}`);
  const body=encodeURIComponent(`Name: ${name}\nEmail: ${email}\nPhone: ${phone||'—'}\n\n${message}`);
  window.location.href=`mailto:info@medwaresol.com?subject=${subject}&body=${body}`;
});
</script>


</body></html>
