<?php
$path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$content = file_get_contents($path);

$oldSection = <<<HTML
        <!-- Database Logos -->
        <section class="py-12 border-b border-slate-200 bg-white">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <div class="flex flex-wrap justify-center items-center gap-10 opacity-60 hover:opacity-100 transition duration-300">
                    <span class="font-black text-2xl tracking-tighter text-slate-800 grayscale hover:grayscale-0 hover:text-blue-600 cursor-default transition-all duration-300">Crossref</span>
                    <span class="font-extrabold text-2xl text-slate-800 grayscale hover:grayscale-0 hover:text-emerald-600 cursor-default transition-all duration-300">DOAJ</span>
                    <span class="font-bold text-xl italic text-slate-800 grayscale hover:grayscale-0 hover:text-purple-600 cursor-default transition-all duration-300">Semantic Scholar</span>
                    <span class="font-black text-2xl text-slate-800 grayscale hover:grayscale-0 hover:text-orange-500 cursor-default transition-all duration-300">OpenAlex</span>
                    <span class="font-bold text-2xl tracking-widest text-slate-800 grayscale hover:grayscale-0 hover:text-slate-900 cursor-default transition-all duration-300">CORE</span>
                    <span class="font-extrabold text-2xl text-slate-800 grayscale hover:grayscale-0 hover:text-blue-800 cursor-default transition-all duration-300">IEEE Xplore</span>
                    <span class="font-bold text-2xl text-slate-800 grayscale hover:grayscale-0 hover:text-teal-600 cursor-default transition-all duration-300">Europe PMC</span>
                    <span class="font-serif font-bold text-3xl text-slate-800 grayscale hover:grayscale-0 hover:text-red-700 cursor-default transition-all duration-300">arXiv</span>
                </div>
            </div>
        </section>
HTML;

$newSection = <<<HTML
        <!-- Database Logos (Infinite Marquee) -->
        <section class="py-12 border-b border-slate-200 bg-white overflow-hidden relative">
            <div class="max-w-7xl mx-auto px-4 text-center mb-6">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Terhubung secara real-time dengan basis data global</p>
            </div>
            
            <!-- Gradient Masks for smooth fading edges -->
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent z-10"></div>

            <div class="relative flex overflow-x-hidden group">
                <div class="flex animate-marquee whitespace-nowrap items-center group-hover:pause-animation">
                    <!-- Set 1 -->
                    <span class="mx-8 font-black text-2xl tracking-tighter text-slate-400 hover:text-blue-600 cursor-default transition-colors duration-300">Crossref</span>
                    <span class="mx-8 font-extrabold text-2xl text-slate-400 hover:text-emerald-600 cursor-default transition-colors duration-300">DOAJ</span>
                    <span class="mx-8 font-bold text-xl italic text-slate-400 hover:text-purple-600 cursor-default transition-colors duration-300">Semantic Scholar</span>
                    <span class="mx-8 font-black text-2xl text-slate-400 hover:text-orange-500 cursor-default transition-colors duration-300">OpenAlex</span>
                    <span class="mx-8 font-bold text-2xl tracking-widest text-slate-400 hover:text-slate-900 cursor-default transition-colors duration-300">CORE</span>
                    <span class="mx-8 font-extrabold text-2xl text-slate-400 hover:text-blue-800 cursor-default transition-colors duration-300">IEEE Xplore</span>
                    <span class="mx-8 font-bold text-2xl text-slate-400 hover:text-teal-600 cursor-default transition-colors duration-300">Europe PMC</span>
                    <span class="mx-8 font-serif font-bold text-3xl text-slate-400 hover:text-red-700 cursor-default transition-colors duration-300">arXiv</span>
                    <!-- Set 2 (Duplicate for infinite scroll loop) -->
                    <span class="mx-8 font-black text-2xl tracking-tighter text-slate-400 hover:text-blue-600 cursor-default transition-colors duration-300">Crossref</span>
                    <span class="mx-8 font-extrabold text-2xl text-slate-400 hover:text-emerald-600 cursor-default transition-colors duration-300">DOAJ</span>
                    <span class="mx-8 font-bold text-xl italic text-slate-400 hover:text-purple-600 cursor-default transition-colors duration-300">Semantic Scholar</span>
                    <span class="mx-8 font-black text-2xl text-slate-400 hover:text-orange-500 cursor-default transition-colors duration-300">OpenAlex</span>
                    <span class="mx-8 font-bold text-2xl tracking-widest text-slate-400 hover:text-slate-900 cursor-default transition-colors duration-300">CORE</span>
                    <span class="mx-8 font-extrabold text-2xl text-slate-400 hover:text-blue-800 cursor-default transition-colors duration-300">IEEE Xplore</span>
                    <span class="mx-8 font-bold text-2xl text-slate-400 hover:text-teal-600 cursor-default transition-colors duration-300">Europe PMC</span>
                    <span class="mx-8 font-serif font-bold text-3xl text-slate-400 hover:text-red-700 cursor-default transition-colors duration-300">arXiv</span>
                </div>
                <!-- Absolute Clone for seamless infinite loop -->
                <div class="absolute top-0 flex animate-marquee2 whitespace-nowrap items-center group-hover:pause-animation">
                    <!-- Set 1 -->
                    <span class="mx-8 font-black text-2xl tracking-tighter text-slate-400 hover:text-blue-600 cursor-default transition-colors duration-300">Crossref</span>
                    <span class="mx-8 font-extrabold text-2xl text-slate-400 hover:text-emerald-600 cursor-default transition-colors duration-300">DOAJ</span>
                    <span class="mx-8 font-bold text-xl italic text-slate-400 hover:text-purple-600 cursor-default transition-colors duration-300">Semantic Scholar</span>
                    <span class="mx-8 font-black text-2xl text-slate-400 hover:text-orange-500 cursor-default transition-colors duration-300">OpenAlex</span>
                    <span class="mx-8 font-bold text-2xl tracking-widest text-slate-400 hover:text-slate-900 cursor-default transition-colors duration-300">CORE</span>
                    <span class="mx-8 font-extrabold text-2xl text-slate-400 hover:text-blue-800 cursor-default transition-colors duration-300">IEEE Xplore</span>
                    <span class="mx-8 font-bold text-2xl text-slate-400 hover:text-teal-600 cursor-default transition-colors duration-300">Europe PMC</span>
                    <span class="mx-8 font-serif font-bold text-3xl text-slate-400 hover:text-red-700 cursor-default transition-colors duration-300">arXiv</span>
                    <!-- Set 2 -->
                    <span class="mx-8 font-black text-2xl tracking-tighter text-slate-400 hover:text-blue-600 cursor-default transition-colors duration-300">Crossref</span>
                    <span class="mx-8 font-extrabold text-2xl text-slate-400 hover:text-emerald-600 cursor-default transition-colors duration-300">DOAJ</span>
                    <span class="mx-8 font-bold text-xl italic text-slate-400 hover:text-purple-600 cursor-default transition-colors duration-300">Semantic Scholar</span>
                    <span class="mx-8 font-black text-2xl text-slate-400 hover:text-orange-500 cursor-default transition-colors duration-300">OpenAlex</span>
                    <span class="mx-8 font-bold text-2xl tracking-widest text-slate-400 hover:text-slate-900 cursor-default transition-colors duration-300">CORE</span>
                    <span class="mx-8 font-extrabold text-2xl text-slate-400 hover:text-blue-800 cursor-default transition-colors duration-300">IEEE Xplore</span>
                    <span class="mx-8 font-bold text-2xl text-slate-400 hover:text-teal-600 cursor-default transition-colors duration-300">Europe PMC</span>
                    <span class="mx-8 font-serif font-bold text-3xl text-slate-400 hover:text-red-700 cursor-default transition-colors duration-300">arXiv</span>
                </div>
            </div>
            
            <style>
                .animate-marquee {
                    animation: marquee 35s linear infinite;
                }
                .animate-marquee2 {
                    animation: marquee2 35s linear infinite;
                }
                .pause-animation {
                    animation-play-state: paused;
                }
                @keyframes marquee {
                    0% { transform: translateX(0%); }
                    100% { transform: translateX(-100%); }
                }
                @keyframes marquee2 {
                    0% { transform: translateX(100%); }
                    100% { transform: translateX(0%); }
                }
            </style>
        </section>
HTML;

$content = str_replace($oldSection, $newSection, $content);
file_put_contents($path, $content);
echo "Marquee added.\n";
?>
