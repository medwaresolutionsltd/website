<?php
include 'blog-data.php';

// Pagination logic
$posts_per_page = 6;
$total_posts = count($blog_posts);
$total_pages = ceil($total_posts / $posts_per_page);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) $current_page = 1;
if ($current_page > $total_pages) $current_page = $total_pages;

// Filter logic (by category)
$active_category = isset($_GET['category']) ? $_GET['category'] : '';
$filtered_posts = $blog_posts;
if ($active_category) {
    $filtered_posts = array_filter($blog_posts, function($p) use ($active_category) {
        return $p['category'] === $active_category;
    });
    $total_posts = count($filtered_posts);
    $total_pages = ceil($total_posts / $posts_per_page);
    if ($current_page > $total_pages) $current_page = 1;
}

// Slice for current page
$start_index = ($current_page - 1) * $posts_per_page;
$current_posts = array_slice($filtered_posts, $start_index, $posts_per_page);

// Sidebar data
$categories = [];
foreach ($blog_posts as $p) {
    $cat = $p['category'];
    if (!isset($categories[$cat])) $categories[$cat] = 0;
    $categories[$cat]++;
}
$recent_posts = array_slice($blog_posts, 0, 5);

// Head elements
$page_title = "Blog - Medware Solutions Ltd";
$page_desc = "Read the latest news, guides, and insights on healthcare infrastructure and medical equipment from Medware Solutions.";
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
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Inter:wght@400;500;600&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/motion.css">
<style>
/* Base styles (copied from index) to ensure consistency */
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

/* Blog Layout */
.page-hero { padding: 60px 0; background: #fff; border-bottom: 1px solid var(--line); text-align: center; }
.page-hero h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 12px; }
.page-hero p { color: var(--grey); font-size: 1.1rem; }

.blog-layout { display: grid; grid-template-columns: 1fr 340px; gap: 40px; padding: 60px 0; align-items: start; }
.post-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }

/* Blog Card */
.blog-card { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; transition: transform 0.2s, box-shadow 0.2s; display: flex; flex-direction: column; }
.blog-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -10px rgba(0,0,0,0.1); }
.card-img-wrap { position: relative; height: 220px; overflow: hidden; }
.card-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
.cat-badge { position: absolute; top: 16px; left: 16px; background: var(--blue); color: #fff; font-size: 0.75rem; font-weight: 700; padding: 4px 12px; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.05em; }
.card-body { padding: 24px; display: flex; flex-direction: column; flex: 1; }
.card-meta { display: flex; align-items: center; gap: 16px; font-size: 0.85rem; color: var(--grey); margin-bottom: 12px; }
.card-meta span { display: inline-flex; align-items: center; gap: 6px; }
.card-meta svg { width: 14px; height: 14px; fill: currentColor; }
.card-title { font-size: 1.25rem; font-weight: 700; line-height: 1.4; color: var(--navy); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

/* Pagination */
.pagination { display: flex; justify-content: center; gap: 8px; margin-top: 40px; }
.page-link { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; background: #fff; border: 1px solid var(--line); font-weight: 600; color: var(--ink); transition: 0.2s; }
.page-link:hover { border-color: var(--blue); color: var(--blue); }
.page-link.active { background: var(--blue); border-color: var(--blue); color: #fff; }

/* Sidebar */
.sidebar-box { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 24px; margin-bottom: 30px; }
.sidebar-box h3 { font-size: 1.15rem; margin-bottom: 16px; font-weight: 800; border-bottom: 2px solid var(--bg); padding-bottom: 12px; }
.cat-list { list-style: none; }
.cat-list li { margin-bottom: 8px; }
.cat-list a { display: flex; justify-content: space-between; align-items: center; color: var(--grey); font-size: 0.95rem; font-weight: 500; padding: 6px 0; transition: color 0.2s; }
.cat-list a:hover, .cat-list a.active { color: var(--blue); }
.cat-list span { background: var(--bg); color: var(--navy); font-size: 0.8rem; font-weight: 700; padding: 2px 8px; border-radius: 99px; }

.recent-post { display: flex; gap: 12px; margin-bottom: 16px; align-items: center; }
.recent-post:last-child { margin-bottom: 0; }
.recent-thumb { width: 64px; height: 64px; border-radius: 6px; object-fit: cover; flex: none; }
.recent-info h4 { font-size: 0.9rem; font-weight: 700; line-height: 1.3; margin-bottom: 4px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.recent-info span { font-size: 0.75rem; color: var(--grey); }

@media (max-width: 920px) {
    .blog-layout { grid-template-columns: 1fr; }
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

<div class="page-hero">
    <div class="wrap">
        <h1>Medware Blog</h1>
        <p>Insights, guides, and news on healthcare infrastructure and medical technology.</p>
    </div>
</div>

<main class="wrap blog-layout">
    
    <!-- Main Content -->
    <div class="main-content">
        <?php if(empty($current_posts)): ?>
            <p>No posts found.</p>
        <?php else: ?>
            <div class="post-grid">
                <?php foreach($current_posts as $post): ?>
                <a href="blog-post?slug=<?= urlencode($post['slug']) ?>" class="blog-card">
                    <div class="card-img-wrap">
                        <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy">
                        <span class="cat-badge"><?= htmlspecialchars($post['category']) ?></span>
                    </div>
                    <div class="card-body">
                        <div class="card-meta">
                            <span>
                                <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                By <?= htmlspecialchars($post['author']) ?>
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/><path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                                <?= htmlspecialchars($post['date']) ?>
                            </span>
                        </div>
                        <h2 class="card-title"><?= htmlspecialchars($post['title']) ?></h2>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            
            <?php if($total_pages > 1): ?>
            <div class="pagination">
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="blog?page=<?= $i ?><?= $active_category ? '&category='.urlencode($active_category) : '' ?>" class="page-link <?= ($i === $current_page) ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-box">
            <h3>Categories</h3>
            <ul class="cat-list">
                <li>
                    <a href="blog" class="<?= !$active_category ? 'active' : '' ?>">All <span><?= count($blog_posts) ?></span></a>
                </li>
                <?php foreach($categories as $cat => $count): ?>
                <li>
                    <a href="blog?category=<?= urlencode($cat) ?>" class="<?= ($active_category === $cat) ? 'active' : '' ?>">
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

