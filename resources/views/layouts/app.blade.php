<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'KOST-SI')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Slick Carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <style>
    /* SCROLLBAR */
    ::-webkit-scrollbar { width: 10px; }
    ::-webkit-scrollbar-track { background: #f1f8ff; }
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #60a5fa, #0a3a82);
        border-radius: 8px;
    }

    /* Animations */
    @keyframes fadeInUp { from { opacity:0; transform: translateY(18px);} to{opacity:1; transform:none;} }
    .animate-fade-in { animation: fadeInUp .6s ease-out both; }

    /* Pattern random "bintang halus" (two sizes, scattered) */
    .pattern-stars {
        background-image:
            radial-gradient(circle, rgba(255,255,255,0.16) 1px, transparent 1px),
            radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);
        background-size: 28px 28px, 56px 56px;
        background-position: 10px 6px, 40px 24px;
    }

    /* Baby-blue / white stripes */
    .section-baby { background: linear-gradient(180deg,#f8fcff 0%, #e8f6ff 100%); }
    .section-white { background: #ffffff; }

    /* Glass card */
    .glass {
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(10px);
    }

    /* Feature card shadow */
    .feature-card { transition: transform .28s ease, box-shadow .28s ease; }
    .feature-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(10,58,130,0.08); }

    /* Testimonial card color alternation */
    .testimonial-card { background: #fff; border-radius: 16px; padding: 28px; box-shadow: 0 14px 30px rgba(10,58,130,0.04); }
    .blue-light { border: 1px solid rgba(59,130,246,0.08); }
    .blue-dark  { border: 1px solid rgba(10,58,130,0.06); }

    /* Image slider style */
    .image-slider .slick-slide img { width:100%; height:100%; object-fit:cover; display:block; }

    /* single footer height */
    footer.site-footer { background: #0A3A82; color:#fff; }
    footer.site-footer a { color: #fff; }

    /* scroll indicator dots (hidden) */
    .slick-dots li button:before { font-size: 8px; color: #cbd5e1; }

    /* make arrows clearer */
    .slick-prev, .slick-next { background: #fff; border-radius: 999px; width:38px; height:38px; display:flex; align-items:center; justify-content:center; box-shadow:0 6px 18px rgba(10,58,130,0.08); }
    .slick-prev i, .slick-next i { color:#0a3a82; }

    /* hero overlay tweak */
    .hero-overlay { background: linear-gradient(90deg, rgba(10,58,130,0.88) 0%, rgba(10,58,130,0.76) 50%, rgba(10,58,130,0.9) 100%); }

    /* responsive tweaks */
    @media (max-width: 768px) {
        .hero-dots h1 { font-size: 2rem; }
        .testimonial-carousel .testimonial-card { padding: 20px; }
    }

    /* subtle rounded large image */
    .rounded-image-xl { border-radius: 18px; box-shadow: 0 18px 40px rgba(10,58,130,0.06); }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased">

    {{-- NAVBAR: tampilkan sesuai routing --}}
    @if (request()->routeIs('home'))
        @include('components.navbar')
    @endif

    <main id="site-main" class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER SINGLE --}}
    <footer class="site-footer py-6">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-3 text-sm">
            <div class="flex items-center gap-3">
                <span class="bg-[#fff] p-2 rounded-full shadow-md"><i data-lucide="home" class="w-5 h-5 text-[#0A3A82]"></i></span>
                <span class="font-semibold text-white">KOST-SI</span>
            </div>

            <div class="text-center text-white/90">
                © {{ date('Y') }} KOST-SI. All rights reserved.
            </div>

            <div class="flex items-center gap-2 text-white/90">
                Dibuat oleh
                <i data-lucide="heart" class="w-4 h-4 text-pink-400"></i>
                <span class="font-semibold">Tim All To Well</span>
            </div>
        </div>
    </footer>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        lucide.createIcons();
    });

    /* Scroll-per-section (debounced). Smooth but not locked. */
    (function(){
        let busy = false;
        let lastTime = 0;
        const delay = 700; // ms between auto moves
        function findSections() {
            return Array.from(document.querySelectorAll('section[data-section]'));
        }
        function indexOfVisible(sections) {
            const scrolly = window.scrollY + window.innerHeight/3;
            for (let i=0;i<sections.length;i++){
                const rect = sections[i].getBoundingClientRect();
                const top = sections[i].offsetTop;
                if (scrolly < top + sections[i].offsetHeight) return i;
            }
            return sections.length-1;
        }
        function scrollToIndex(i) {
            const sections = findSections();
            if (!sections[i]) return;
            busy = true;
            sections[i].scrollIntoView({behavior:'smooth'});
            setTimeout(()=> busy=false, delay);
        }
        let sections = findSections();
        window.addEventListener('resize', ()=> sections = findSections());

        window.addEventListener('wheel', (e)=>{
            const now = Date.now();
            if (busy || (now - lastTime) < 160) return;
            lastTime = now;
            const s = findSections();
            if (!s.length) return;
            const idx = indexOfVisible(s);
            if (e.deltaY > 20) {
                const next = Math.min(s.length-1, idx+1);
                if (next !== idx) { scrollToIndex(next); }
            } else if (e.deltaY < -20) {
                const prev = Math.max(0, idx-1);
                if (prev !== idx) { scrollToIndex(prev); }
            }
        }, {passive:true});

        // touch support (swipe)
        let touchStartY = null;
        window.addEventListener('touchstart', (e)=> { touchStartY = e.touches[0].clientY; }, {passive:true});
        window.addEventListener('touchend', (e)=> {
            if (touchStartY === null) return;
            const touchEndY = (e.changedTouches && e.changedTouches[0].clientY) || 0;
            const diff = touchStartY - touchEndY;
            if (Math.abs(diff) < 40) { touchStartY = null; return; }
            const s = findSections();
            const idx = indexOfVisible(s);
            if (diff > 40) scrollToIndex(Math.min(s.length-1, idx+1));
            else scrollToIndex(Math.max(0, idx-1));
            touchStartY = null;
        }, {passive:true});
    })();
    </script>

    @stack('scripts')
</body>
</html>
