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
