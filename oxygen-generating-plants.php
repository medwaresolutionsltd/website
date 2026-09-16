<?php
$page_title = "Oxygen Generating Plants — Medware Solutions Ltd";
$page_desc = "On-site PSA oxygen generation for independent medical oxygen supply.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --blue:#1B75BC;
  --blue-d:#0F5A99;
  --navy:#28316E;
  --sky:#5FA8DC;
  --grey:#6D6E71;
  --ink:#2C3038;
  --bg:#F4F6F9;
  --panel:#FFFFFF;
  --line:#DCE3EC;
  --radius:10px;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:"Inter",system-ui,sans-serif;background:var(--bg);color:var(--ink);line-height:1.65;font-size:16.5px}
h1,h2,h3,h4{font-family:"Montserrat",sans-serif;line-height:1.15;color:var(--navy)}
h1 em,h2 em,h3 em{font-style:normal;color:var(--blue)}
.kicker{font-family:"Montserrat",sans-serif;font-weight:700;font-size:.74rem;letter-spacing:.16em;text-transform:uppercase;color:var(--blue)}
.wrap{width:90%;max-width:1140px;margin:0 auto}
a{color:inherit}
img{max-width:100%;display:block}
.band{display:flex;height:5px;width:100%}
.band span{flex:1}
.band .b1{background:var(--blue)}
.band .b2{background:var(--navy)}
.band .b3{background:var(--sky)}
.band .b4{background:var(--grey)}
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
.nav-item{position:relative;display:flex;align-items:center}
.dropdown{position:absolute;top:100%;left:50%;transform:translateX(-50%);background:#fff;border:1px solid var(--line);border-radius:10px;box-shadow:0 20px 44px -20px rgba(15,90,153,.35);padding:8px;min-width:250px;opacity:0;visibility:hidden;pointer-events:none;transition:opacity .15s ease;z-index:60}
.nav-item:hover .dropdown{opacity:1;visibility:visible;pointer-events:auto}
nav.links .dropdown a{display:block;padding:9px 12px;border-radius:6px;font-size:.86rem;font-weight:600;color:var(--ink);border-bottom:0}
nav.links .dropdown a:hover{background:rgba(27,117,188,.1);color:var(--blue);}
section{padding:80px 0}
.sec-head{max-width:680px;margin-bottom:48px}
.sec-head .kicker{display:inline-flex;align-items:center;gap:10px;margin-bottom:14px}
.sec-head .kicker::before{content:"";width:26px;height:3px;background:var(--blue);display:inline-block}
.sec-head h2{font-size:clamp(1.7rem,3.4vw,2.4rem);font-weight:800;letter-spacing:-.015em}
.sec-head p{margin-top:14px;color:var(--grey)}
.page-hero{background:linear-gradient(120deg,var(--navy),var(--blue));color:#fff;padding:72px 0 56px}
.page-hero h1{color:#fff;font-size:clamp(2rem,4.6vw,3.1rem);font-weight:800;letter-spacing:-.02em;max-width:20ch}
.page-hero p{margin-top:14px;color:#D6E4F5;max-width:62ch}
.page-hero .kicker{color:#9CC4E8;display:block;margin-bottom:12px}
.auth-badge{display:inline-flex;align-items:flex-start;gap:12px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);padding:16px 20px;border-radius:8px;margin-top:32px;max-width:62ch}
.auth-badge svg{width:28px;height:28px;color:#fff;flex:none;margin-top:2px}
.auth-badge span{font-size:.9rem;line-height:1.5;color:#D6E4F5}
.backlink{display:inline-block;margin-top:24px;font-size:.95rem;font-weight:600;color:var(--blue);text-decoration:none}
.backlink:hover{text-decoration:underline}
.item-list{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-top:16px}
.item{background:#fff;border:1px solid var(--line);border-radius:var(--radius);overflow:hidden;display:flex;flex-direction:column}
.item .i-media{aspect-ratio:4/3;background:var(--bg);display:flex;align-items:center;justify-content:center;padding:18px}
.item .i-media img{max-width:100%;max-height:100%;object-fit:contain}
.item .i-body{padding:22px}
.item .p-cat{font-size:.66rem;letter-spacing:.1em;text-transform:uppercase;font-weight:700;color:var(--blue)}
.item h4{font-size:1.02rem;font-weight:800;margin-top:6px}
.item p{color:var(--grey);font-size:.9rem;margin-top:8px}
.cta{background:var(--navy);color:#fff;padding:64px 0;text-align:center}
.cta h2{color:#fff;font-size:clamp(1.6rem,3.2vw,2.2rem)}
.cta p{margin:14px auto 28px;color:#D6E4F5;max-width:52ch}
.cta .hero-cta{display:flex;gap:14px;flex-wrap:wrap;justify-content:center}
footer{background:var(--navy);color:#AEBBDF;padding:34px 0}
footer .wrap{display:flex;flex-wrap:wrap;gap:16px;justify-content:space-between;align-items:center}
footer .f-brand{display:inline-flex;background:#fff;border-radius:8px;padding:10px 16px}
footer .f-brand img{height:52px;width:auto;display:block}
footer p{font-size:.88rem}
footer nav{display:flex;gap:22px}
footer nav a{text-decoration:none;font-size:.88rem;color:#D2DCF2}
footer nav a:hover{color:#fff}
@media (max-width:900px){.item-list{grid-template-columns:repeat(2,1fr)}}
@media (max-width:760px){.item-list{grid-template-columns:1fr}}
</style>
<link rel="stylesheet" href="assets/css/motion.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<main id="top">
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="wrap">
      <span class="kicker">Products / Medical Gas Systems / Oxygen Plants</span>
      <h1>Oxygen Generating Plants</h1>
      <p>On-site PSA oxygen generation for an independent, continuous medical oxygen supply, eliminating the logistical challenges of cylinder deliveries.</p>
      
    </div>
  </section>

  <!-- INTRO -->
  <section>
    <div class="wrap">
      <div class="sec-head">
        <span class="kicker">Product Overview</span>
        <h2>On-Site Independence</h2>
        <p>Produce your own medical oxygen reliably and cost-effectively directly at your hospital site.</p>
        <a class="backlink" href="medical-gas-systems">? Back to Medical Gas Systems</a>
      </div>

      <div class="item-list">
        <div class="item reveal">
  <div class="i-media"><img src="assets/images/products/psa_generator.jpg" alt="PSA Oxygen Generator" loading="lazy"></div><div class="i-body"><span class="p-cat">Generation</span>
    <h4>PSA Oxygen Generators</h4>
    <p>Pressure Swing Adsorption (PSA) technology separates oxygen from ambient air, producing a continuous stream of medical-grade oxygen.</p>
  </div>
</div>
<div class="item reveal">
  <div class="i-media"><img src="assets/images/products/cylinder_filling.jpg" alt="Cylinder Filling System" loading="lazy"></div><div class="i-body"><span class="p-cat">Storage & Backup</span>
    <h4>Cylinder Filling & Backup</h4>
    <p>Integrated cylinder filling stations and high-pressure storage to ensure a secure backup supply during peak demand or power interruptions.</p>
  </div>
</div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <div class="cta">
    <div class="wrap">
      <h2>Ready to upgrade your infrastructure?</h2>
      <p>Contact us to schedule a consultation with our biomedical engineering team.</p>
      <div class="hero-cta">
        <a href="index#contact" class="btn">Request a Consultation</a>
        <a href="projects" class="btn ghost">View our projects</a>
      </div>
    </div>
  </div>

</main>

<?php include 'partials/footer.php'; ?>

</body>
</html>


