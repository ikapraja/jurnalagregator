<?php
$path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$content = file_get_contents($path);

// 1. Scroll-to-Top Button
$scrollToTop = <<<HTML
    <!-- Scroll to Top Button -->
    <div x-data="{ showScroll: false }" @scroll.window="showScroll = (window.pageYOffset > 400)">
        <button x-show="showScroll" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-8"
                @click="window.scrollTo({top: 0, behavior: 'smooth'})" 
                class="fixed bottom-8 right-8 z-50 bg-[#FBBF24] text-[#1E3A8A] p-3.5 rounded-full shadow-xl hover:bg-amber-400 hover:scale-110 hover:shadow-amber-500/20 transition-all focus:outline-none"
                style="display: none;" title="Kembali ke Atas">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
        </button>
    </div>

    <!-- Loading Overlay -->
HTML;
$content = str_replace('    <!-- Loading Overlay -->', $scrollToTop, $content);

// 2. Fade-in Animation on Cards
$cardOld = '<article class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition duration-200">';
$cardNew = '<article class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition duration-200 animate-slide-up" style="animation-fill-mode: both; animation-delay: {{ $loop->index * 60 }}ms;">';
$content = str_replace($cardOld, $cardNew, $content);

$styleOld = '</style>';
$styleNew = <<<HTML
        @keyframes slide-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-up {
            animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
HTML;
$content = str_replace($styleOld, $styleNew, $content);

// 3. Empty State Design
$emptyOld = <<<HTML
                        <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                            <h3 class="text-lg font-bold text-slate-900">Tidak ada artikel ditemukan</h3>
                            <p class="mt-1 text-sm text-slate-500 font-medium">Coba gunakan kata kunci lain atau longgarkan filter pencarian Anda.</p>
                        </div>
HTML;
$emptyNew = <<<HTML
                        <div class="text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center animate-slide-up">
                            <div class="w-24 h-24 mb-6 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-slate-800 mb-2">Jurnal Tidak Ditemukan</h3>
                            <p class="text-slate-500 font-medium max-w-md mx-auto mb-6">Kami tidak dapat menemukan literatur yang cocok dengan kata kunci atau filter Anda. Coba gunakan istilah yang lebih umum.</p>
                            <button @click="window.scrollTo({top: 0, behavior: 'smooth'}); document.querySelector('input[name=q]').focus();" class="px-6 py-2.5 bg-[#1E3A8A] text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-sm">
                                Coba Kata Kunci Lain
                            </button>
                        </div>
HTML;
$content = str_replace($emptyOld, $emptyNew, $content);

file_put_contents($path, $content);
echo "search.blade.php updated.\n";
?>
