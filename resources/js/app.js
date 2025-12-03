// resources/js/app.js
document.addEventListener("DOMContentLoaded", ()=>{

  // lucide icons (jika dipakai)
  if(window.lucide) window.lucide.createIcons();

  // Intersection Observer untuk fade-in / stagger
  const observer = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if(entry.isIntersecting){
        entry.target.classList.add("show");
      }
    });
  }, { threshold: 0.15 });

  document.querySelectorAll(".fade-up, .fade-left, .fade-right, .stagger")
    .forEach(el => observer.observe(el));

  // NAVBAR scrollspy
  const sections = document.querySelectorAll("section[id]");
  const navLinks = document.querySelectorAll("a[data-link]");

  function onScrollSpy(){
    const scrollPos = window.pageYOffset + 140;
    sections.forEach(sec=>{
      const top = sec.offsetTop;
      const bottom = top + sec.offsetHeight;
      if(scrollPos >= top && scrollPos < bottom){
        const id = sec.getAttribute("id");
        navLinks.forEach(a=>{
          a.classList.remove("active-nav");
          if(a.dataset.link === id) a.classList.add("active-nav");
        });
      }
    });
  }
  window.addEventListener("scroll", onScrollSpy);
  onScrollSpy();

  // DARK MODE toggle
  const tbtn = document.getElementById("theme-toggle");
  if(tbtn){
    const saved = localStorage.getItem("pref-theme");
    if(saved === "dark") document.documentElement.classList.add("dark");
    tbtn.addEventListener("click", ()=>{
      document.documentElement.classList.toggle("dark");
      const mode = document.documentElement.classList.contains("dark") ? "dark" : "light";
      localStorage.setItem("pref-theme", mode);
    });
  }

  // Testimonial carousel autoplay
  const track = document.querySelector(".testi-track");
  if(track){
    let idx = 0;
    const items = track.querySelectorAll(".testi-item");
    const gap = 24;
    const step = items[0].offsetWidth + gap;
    function slide(){
      idx++;
      if(idx > items.length - 1) idx = 0;
      track.style.transform = `translateX(${-(step * idx)}px)`;
    }
    // start after small delay
    setInterval(slide, 3500);
    // responsive: recalc on resize
    window.addEventListener("resize", ()=> {
      // noop for now; CSS handles sizing
    });
  }

});
