// Load Lenis for buttery smooth scrolling (like Amkon)
const lenisScript = document.createElement('script');
lenisScript.src = 'https://unpkg.com/lenis@1.1.13/dist/lenis.min.js';
document.head.appendChild(lenisScript);

lenisScript.onload = () => {
  const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smooth: true,
  });
  function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
  }
  requestAnimationFrame(raf);
};

// Amkon-style character splitting for headings (matches GSAP opal-move-left / y:60)
function splitText(selector) {
  document.querySelectorAll(selector).forEach(el => {
    if (el.classList.contains('split-applied')) return;
    if(el.children.length > 0) return; 
    
    const text = el.innerText.trim();
    el.innerHTML = '';
    const words = text.split(' ');
    
    words.forEach(word => {
      const wordWrap = document.createElement('span');
      wordWrap.className = 'word-wrap';
      wordWrap.style.display = 'inline-block';
      wordWrap.style.whiteSpace = 'nowrap';
      
      const chars = word.split('');
      chars.forEach(char => {
          const charSpan = document.createElement('span');
          charSpan.className = 'amkon-char';
          charSpan.style.display = 'inline-block';
          charSpan.style.opacity = '0';
          charSpan.style.transform = 'translateY(60px)';
          charSpan.style.transition = 'transform 0.8s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.8s ease';
          charSpan.innerText = char;
          wordWrap.appendChild(charSpan);
      });
      
      el.appendChild(wordWrap);
      el.appendChild(document.createTextNode(' '));
    });
    el.classList.add('split-applied');
  });
}

// Upgrade buttons to Amkon style dynamically
function upgradeButtons() {
    document.querySelectorAll('.btn').forEach(btn => {
        if(btn.querySelector('.hover-text')) return;
        const text = btn.innerText.trim();
        btn.classList.add('amkon-btn');
        btn.innerHTML = `
            <span class="btn-icon">
                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
            </span>
            <span class="hover-text" data-name="${text}"><span>${text}</span></span>
        `;
    });
}

document.addEventListener("DOMContentLoaded", () => {
    splitText('h1:not(.no-split), h2:not(.no-split)');
    upgradeButtons();
    
    document.querySelectorAll('img:not(.brand-logo):not(.recent-thumb)').forEach(img => {
      if(img.parentElement.classList.contains('img-reveal-wrap')) return;
      const wrap = document.createElement('div');
      wrap.className = 'img-reveal-wrap';
      wrap.style.width = img.style.width || (img.getAttribute('width') ? img.getAttribute('width') + 'px' : '100%');
      wrap.style.height = img.style.height || (img.getAttribute('height') ? img.getAttribute('height') + 'px' : 'auto');
      img.parentNode.insertBefore(wrap, img);
      wrap.appendChild(img);
      img.classList.add('img-reveal');
    });

        const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('amkon-visible');
          obs.unobserve(entry.target);
          
          const chars = entry.target.querySelectorAll('.amkon-char');
          chars.forEach((char, i) => {
            setTimeout(() => {
              char.style.transform = 'translateY(0)';
              char.style.opacity = '1';
            }, i * 30); // 30ms stagger matching Amkon's 0.03 gsap_split_stagger
          });
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.split-applied, .img-reveal-wrap, .reveal, .blog-card, .proj, .svc').forEach(el => {
      observer.observe(el);
    });
});

// Automatic stagger for grouped reveal elements
const revealGroups = new Map();
document.querySelectorAll('.reveal, .blog-card, .proj, .svc').forEach(el => {
  const parent = el.parentElement;
  if(!revealGroups.has(parent)) revealGroups.set(parent, []);
  revealGroups.get(parent).push(el);
});
revealGroups.forEach((list, parent) => {
  const base = parent.classList.contains('hero-meta') ? 480 : 0;
  list.forEach((el, i) => { el.style.transitionDelay = (base + Math.min(i, 8) * 100) + 'ms'; });
});

function toggleMenu(btn){
  const m=document.getElementById('menu');
  const open=m.classList.toggle('open');
  btn.setAttribute('aria-expanded',open);
}

document.querySelectorAll('[data-href]').forEach(card=>{
  card.addEventListener('click',e=>{
    if(e.target.closest('a'))return;
    window.location.href=card.dataset.href;
  });
  card.addEventListener('keydown',e=>{
    if((e.key==='Enter'||e.key===' ')&&!e.target.closest('a')){
      e.preventDefault();
      window.location.href=card.dataset.href;
    }
  });
});

const subnav=document.querySelector('.subnav');
if(subnav){
  const hero=document.querySelector('.hero, .page-hero');
  if(hero){
    const heroIO=new IntersectionObserver(es=>{
      subnav.classList.toggle('visible',!es[0].isIntersecting);
    },{rootMargin:'-96px 0px 0px 0px'});
    heroIO.observe(hero);
  }

  const subnavLinks=Array.from(subnav.querySelectorAll('a[href^="#"]'));
  const sections=subnavLinks
    .map(a=>document.querySelector(a.getAttribute('href')))
    .filter(Boolean);
  if(sections.length){
    const spyIO=new IntersectionObserver(es=>{
      es.forEach(entry=>{
        if(entry.isIntersecting){
          const id='#'+entry.target.id;
          subnavLinks.forEach(a=>a.classList.toggle('active',a.getAttribute('href')===id));
        }
      });
    },{rootMargin:'-40% 0px -50% 0px'});
    sections.forEach(s=>spyIO.observe(s));
  }
}

