<?php
include 'blog-data.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$post = null;

foreach ($blog_posts as $p) {
    if ($p['slug'] === $slug) {
        $post = $p;
        break;
    }
}

if (!$post) {
    header("HTTP/1.0 404 Not Found");
    echo "Post not found. <a href='blog'>Back to blog</a>";
    exit;
}

// Sidebar data
$categories = [];
foreach ($blog_posts as $p) {
    $cat = $p['category'];
    if (!isset($categories[$cat])) $categories[$cat] = 0;
    $categories[$cat]++;
}
$recent_posts = array_slice($blog_posts, 0, 5);

// "More from the blog" (random 2-3 posts excluding current)
$other_posts = array_filter($blog_posts, function($p) use ($slug) {
    return $p['slug'] !== $slug;
});
shuffle($other_posts);
$more_posts = array_slice($other_posts, 0, 2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($post['meta_title']) ?></title>
<meta name="description" content="<?= htmlspecialchars($post['meta_description']) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Inter:wght@400;500;600&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/motion.css">
<style>
/* Base styles */
:root{
  --blue:#1B75BC;
  --blue-d:#0F5A99;
  --navy:#28316E;
  --sky:#5FA8DC;
  --grey:#6D6E71;
  --ink:#2C3038;
  --bg:#F4F6F9;
  --line:#DCE3EC;
  --radius:10px;
}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:"Inter",system-ui,sans-serif;background:var(--bg);color:var(--ink);line-height:1.65;font-size:16.5px}
h1,h2,h3,h4{font-family:"Montserrat",sans-serif;line-height:1.15;color:var(--navy)}
a{color:inherit; text-decoration:none;}
img{max-width:100%;display:block}
.wrap{width:90%;max-width:1140px;margin:0 auto}

/* Header/Footer specifics */
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
nav.links .btn{font-weight:700;padding:11px 22px;background:var(--blue);color:#fff;border-radius:8px;}
nav.links .btn:hover{background:var(--blue-d);color:#fff;}
.menu-btn{display:none;background:none;border:0;cursor:pointer;padding:8px}
.menu-btn span{display:block;width:22px;height:2px;background:var(--navy);margin:5px 0;border-radius:2px}
.nav-item{position:relative;display:flex;align-items:center}
.dropdown{position:absolute;top:100%;left:50%;transform:translateX(-50%);background:#fff;border:1px solid var(--line);border-radius:10px;box-shadow:0 20px 44px -20px rgba(15,90,153,.35);padding:8px;min-width:250px;opacity:0;visibility:hidden;pointer-events:none;transition:opacity .15s ease;z-index:60}
.nav-item:hover .dropdown{opacity:1;visibility:visible;pointer-events:auto}
nav.links .dropdown a{display:block;padding:9px 12px;border-radius:6px;font-size:.86rem;font-weight:600;color:var(--ink);border-bottom:0}
nav.links .dropdown a:hover{background:rgba(27,117,188,.1);color:var(--blue);}

footer{background:var(--navy);color:#AEBBDF;padding:34px 0}
footer .wrap{display:flex;flex-wrap:wrap;gap:16px;justify-content:space-between;align-items:center}
footer .f-brand{display:inline-flex;background:#fff;border-radius:8px;padding:10px 16px}
footer .f-brand img{height:52px;width:auto;display:block}
footer p{font-size:.88rem}
footer nav{display:flex;gap:22px}
footer nav a{text-decoration:none;font-size:.88rem;color:#D2DCF2}
footer nav a:hover{color:#fff}

/* Layout */
.blog-layout { display: grid; grid-template-columns: 1fr 340px; gap: 50px; padding: 60px 0; align-items: start; }

/* Article styling */
.article-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; }
.article-hero { width: 100%; height: 400px; object-fit: cover; }
.article-inner { padding: 40px; }
.cat-badge { display: inline-block; background: var(--blue); color: #fff; font-size: 0.8rem; font-weight: 700; padding: 4px 12px; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 16px; }
.article-meta { display: flex; align-items: center; gap: 16px; font-size: 0.9rem; color: var(--grey); margin-bottom: 30px; border-bottom: 1px solid var(--line); padding-bottom: 20px; margin-top:16px;}
.article-meta span { display: inline-flex; align-items: center; gap: 6px; }
.article-meta svg { width: 16px; height: 16px; fill: currentColor; }

/* Post Content Typography */
.post-content { font-family: "Merriweather", serif; font-size: 1.1rem; line-height: 1.8; color: #333; max-width: 720px; margin: 0 auto; }
.post-content h1 { font-family: "Montserrat", sans-serif; font-size: 2.4rem; font-weight: 800; line-height: 1.2; margin-bottom: 0; color: var(--navy); }
.post-content h2 { font-family: "Montserrat", sans-serif; font-size: 1.6rem; font-weight: 700; margin: 40px 0 16px; color: var(--navy); }
.post-content p { margin-bottom: 20px; }
.post-content a { color: var(--blue); font-weight: 700; border-bottom: 1px dotted var(--blue); transition: 0.2s; }
.post-content a:hover { color: var(--blue-d); border-bottom-color: var(--blue-d); }
.post-content ul, .post-content ol { margin-bottom: 20px; padding-left: 20px; }
.post-content li { margin-bottom: 8px; }

/* FAQs */
.faq-accordion { margin-top: 20px; }
.faq-accordion details { background: var(--bg); border: 1px solid var(--line); border-radius: 8px; margin-bottom: 10px; padding: 12px 16px; }
.faq-accordion summary { font-family: "Inter", sans-serif; font-weight: 600; font-size: 1.05rem; cursor: pointer; color: var(--navy); outline: none; }
.faq-accordion summary::-webkit-details-marker { display: none; }
.faq-accordion p { margin: 12px 0 0 0; font-size: 1rem; color: var(--grey); }

/* Sidebar */
.sidebar-box { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; margin-bottom: 30px; }
.sidebar-box h3 { font-family: "Montserrat", sans-serif; font-size: 1.15rem; margin-bottom: 16px; font-weight: 800; border-bottom: 2px solid var(--bg); padding-bottom: 12px; color: var(--navy); }
.cat-list { list-style: none; }
.cat-list li { margin-bottom: 8px; }
.cat-list a { display: flex; justify-content: space-between; align-items: center; color: var(--grey); font-size: 0.95rem; font-weight: 500; padding: 6px 0; transition: color 0.2s; border:0; }
.cat-list a:hover { color: var(--blue); }
.cat-list span { background: var(--bg); color: var(--navy); font-size: 0.8rem; font-weight: 700; padding: 2px 8px; border-radius: 99px; }

.recent-post { display: flex; gap: 12px; margin-bottom: 16px; align-items: center; border:0; }
.recent-post:last-child { margin-bottom: 0; }
.recent-thumb { width: 64px; height: 64px; border-radius: 6px; object-fit: cover; flex: none; }
.recent-info h4 { font-family: "Inter", sans-serif; font-size: 0.9rem; font-weight: 700; line-height: 1.3; margin-bottom: 4px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; color: var(--navy); }
.recent-info span { font-family: "Inter", sans-serif; font-size: 0.75rem; color: var(--grey); }

/* More posts */
.more-posts { margin-top: 50px; border-top: 1px solid var(--line); padding-top: 40px; }
.more-posts h3 { font-size: 1.5rem; margin-bottom: 24px; }
.post-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
.blog-card { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; display: flex; flex-direction: column; border:0; }
.blog-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -10px rgba(0,0,0,0.1); border:0; }
.card-img-wrap { position: relative; height: 180px; overflow: hidden; }
.card-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
.card-body { padding: 20px; display: flex; flex-direction: column; flex: 1; }
.card-title { font-family: "Inter", sans-serif; font-size: 1.1rem; font-weight: 700; line-height: 1.4; color: var(--navy); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

@media (max-width: 920px) {
    .blog-layout { grid-template-columns: 1fr; }
    .article-hero { height: 260px; }
    .article-inner { padding: 24px; }
}
@media (max-width: 640px) {
    .post-grid { grid-template-columns: 1fr; }
    nav.links{display:none;position:absolute;top:96px;left:0;right:0;background:#fff;border-bottom:1px solid var(--line);flex-direction:column;padding:18px 24px;gap:16px;align-items:flex-start}
    .nav-item{flex-direction:column;align-items:flex-start;width:100%}
    .dropdown{position:static;opacity:1;visibility:visible;pointer-events:auto;transform:none;box-shadow:none;border:0;background:transparent;padding:2px 0 0 14px;margin:0;min-width:0}
    .menu-btn{display:block}
}
</style>
</head>
<body>

<?php include 'partials/header.php'; ?>

<main class="wrap blog-layout">
    
    <!-- Main Content -->
    <div class="article-wrap">
        <img class="article-hero" src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
        
        <div class="article-inner">
            <span class="cat-badge"><?= htmlspecialchars($post['category']) ?></span>
            
            <div class="post-content">
                <?php
                // Inject the author/date byline right after the H1
                $meta_html = '
                <div class="article-meta">
                    <span>
                        <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        By ' . htmlspecialchars($post["author"]) . '
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/><path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                        ' . htmlspecialchars($post["date"]) . '
                    </span>
                </div>';
                
                $content = preg_replace('/(<\/h1>)/i', '$1' . $meta_html, $post['content'], 1);
                echo $content;
                ?>
            </div>
            
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-box">
            <h3>Categories</h3>
            <ul class="cat-list">
                <li><a href="blog">All <span><?= count($blog_posts) ?></span></a></li>
                <?php foreach($categories as $cat => $count): ?>
                <li>
                    <a href="blog?category=<?= urlencode($cat) ?>">
                        <?= htmlspecialchars($cat) ?> <span><?= $count ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="sidebar-box">
            <h3>Recent Posts</h3>
            <?php foreach($recent_posts as $rp): ?>
            <a href="blog-post?slug=<?= urlencode($rp['slug']) ?>" class="recent-post">
                <img src="<?= htmlspecialchars($rp['image']) ?>" alt="<?= htmlspecialchars($rp['title']) ?>" class="recent-thumb" loading="lazy">
                <div class="recent-info">
                    <h4><?= htmlspecialchars($rp['title']) ?></h4>
                    <span><?= htmlspecialchars($rp['date']) ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </aside>

</main>

<div class="wrap">
    <div class="more-posts">
        <h3>More from the blog</h3>
        <div class="post-grid">
            <?php foreach($more_posts as $mp): ?>
            <a href="blog-post?slug=<?= urlencode($mp['slug']) ?>" class="blog-card" style="border:1px solid #DCE3EC;">
                <div class="card-img-wrap">
                    <img src="<?= htmlspecialchars($mp['image']) ?>" alt="<?= htmlspecialchars($mp['title']) ?>" loading="lazy">
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?= htmlspecialchars($mp['title']) ?></h4>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <div style="margin-bottom: 60px;"></div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<script>
function toggleMenu(btn) {
    const menu = document.getElementById('menu');
    btn.setAttribute('aria-expanded', btn.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
    menu.classList.toggle('open');
}
</script>
</body>
</html>

