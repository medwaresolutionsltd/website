function toggleMenu(btn){
  const m=document.getElementById('menu');
  const open=m.classList.toggle('open');
  btn.setAttribute('aria-expanded',open);
}
document.querySelectorAll('#menu a').forEach(a=>a.addEventListener('click',()=>{
  document.getElementById('menu').classList.remove('open');
}));

/* Stagger scroll-reveals that share a parent, so grids/lists cascade in
   instead of popping together. Hero stat row gets an extra base delay so it
   follows the hero-top entrance animation rather than racing it. */
const revealGroups=new Map();
document.querySelectorAll('.reveal').forEach(el=>{
  const parent=el.parentElement;
  if(!revealGroups.has(parent))revealGroups.set(parent,[]);
  revealGroups.get(parent).push(el);
});
revealGroups.forEach((list,parent)=>{
  const base=parent.classList.contains('hero-meta')?480:0;
  list.forEach((el,i)=>{el.style.transitionDelay=(base+Math.min(i,6)*70)+'ms'});
});

const io=new IntersectionObserver(es=>es.forEach(e=>{
  if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}
}),{threshold:.12});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));

/* Clickable cards: whole element navigates to data-href, but clicks on a
   nested <a> (e.g. chips inside a service card) keep following their own href. */
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

/* Section sub-nav: fade it in once the hero (which has its own jump chips)
   scrolls out from under the sticky header, and highlight whichever linked
   section is currently in view. No-op on pages without a .subnav. */
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
