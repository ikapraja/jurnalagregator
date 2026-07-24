<?php
$files = [
    'resources/views/search.blade.php',
    'resources/views/how-to-use.blade.php',
    'resources/views/detail.blade.php',
    'resources/views/faq.blade.php',
    'resources/views/about.blade.php',
];

$newFooter = <<<HTML
    <!-- Footer -->
    <footer class="relative bg-[#18233A] pt-16 pb-12 mt-auto text-white overflow-hidden font-sans">
        <!-- Optional Dot Pattern if needed, but keeping it clean for the new design -->
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-5"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- 4 Column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                
                <!-- Column 1: Identitas & Kontak -->
                <div class="flex flex-col gap-5">
                    <!-- Logos -->
                    <div class="flex items-center gap-3 bg-white/5 w-fit py-2 px-3 rounded-xl border border-white/10">
                        <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-12 w-auto object-contain" onerror="this.outerHTML='<div class=\'w-10 h-10 bg-transparent border border-white/30 rounded-full flex items-center justify-center text-white font-bold text-xl\'>P</div>'">
                        <div class="flex flex-col">
                            <h2 class="text-sm font-extrabold text-white tracking-tight leading-tight">PERPUSTAKAAN</h2>
                            <h2 class="text-sm font-extrabold text-[#FBBF24] tracking-tight leading-tight">PKTJ TEGAL</h2>
                        </div>
                    </div>
                    
                    <!-- NPP Badge -->
                    <div class="bg-[#FBBF24] text-[#18233A] text-xs font-bold px-3 py-1.5 rounded w-fit mt-1">
                        NPP 3376022C0000001
                    </div>
                    
                    <!-- Addresses -->
                    <ul class="flex flex-col gap-4 mt-2">
                        <li class="flex items-start gap-3 text-sm text-slate-300">
                            <svg class="w-5 h-5 text-[#FBBF24] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div class="flex flex-col pb-4 border-b border-dotted border-white/20 w-full">
                                <span class="font-bold text-white">Perpustakaan Margadana:</span>
                                <span>Jl. Abdul Syukur No. 17, Kota Tegal</span>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 text-sm text-slate-300">
                            <svg class="w-5 h-5 text-[#FBBF24] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div class="flex flex-col pb-4 border-b border-dotted border-white/20 w-full">
                                <span class="font-bold text-white">Perpustakaan Perintis:</span>
                                <span>Jl. Perintis Kemerdekaan No. 17, Kota Tegal</span>
                            </div>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <svg class="w-5 h-5 text-[#FBBF24] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            library@pktj.ac.id
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <svg class="w-5 h-5 text-[#FBBF24] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            (0283) 351061
                        </li>
                    </ul>
                </div>

                <!-- Column 2: Jam Layanan -->
                <div class="flex flex-col gap-6 lg:pl-4">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-base font-bold text-white tracking-wide">Jam Layanan</h3>
                        <div class="w-8 h-0.5 bg-[#FBBF24]"></div>
                    </div>
                    <div class="flex flex-col gap-4 text-sm text-slate-300">
                        <div class="grid grid-cols-[100px_1fr] gap-2">
                            <span>Senin - Kamis</span>
                            <span>: 08.00 - 16.00 WIB</span>
                        </div>
                        <div class="grid grid-cols-[100px_1fr] gap-2">
                            <span>Jumat</span>
                            <span>: 08.30 - 16.30 WIB</span>
                        </div>
                        <div class="grid grid-cols-[100px_1fr] gap-2">
                            <span>Sabtu - Minggu</span>
                            <span>: Tutup</span>
                        </div>
                        <div class="grid grid-cols-[100px_1fr] gap-2">
                            <span>Libur Nasional</span>
                            <span>: Tutup</span>
                        </div>
                    </div>
                </div>
                
                <!-- Column 3: Navigasi Agregator -->
                <div class="flex flex-col gap-6 lg:pl-4">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-base font-bold text-white tracking-wide">Navigasi</h3>
                        <div class="w-8 h-0.5 bg-[#FBBF24]"></div>
                    </div>
                    <ul class="flex flex-col gap-4">
                        <li>
                            <a href="{{ route('search.index') }}" class="flex items-center gap-2 text-sm text-slate-300 hover:text-white transition-colors group">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('how-to-use') }}" class="flex items-center gap-2 text-sm text-slate-300 hover:text-white transition-colors group">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Cara Menggunakan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}" class="flex items-center gap-2 text-sm text-slate-300 hover:text-white transition-colors group">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="flex items-center gap-2 text-sm text-slate-300 hover:text-white transition-colors group">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Tentang
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Column 4: Pusat Informasi -->
                <div class="flex flex-col gap-6 lg:pl-4">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-base font-bold text-white tracking-wide">Pusat Informasi</h3>
                        <div class="w-8 h-0.5 bg-[#FBBF24]"></div>
                    </div>
                    <ul class="flex flex-col gap-4">
                        <li>
                            <a href="https://library.pktj.ac.id/" target="_blank" class="flex items-center gap-2 text-sm text-slate-300 hover:text-white transition-colors group">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Website Utama PKTJ
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-sm text-slate-300 hover:text-white transition-colors group">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Repositori Institusi
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-sm text-slate-300 hover:text-white transition-colors group">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Bebas Pustaka
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-sm text-slate-300 hover:text-white transition-colors group">
                                <svg class="w-3.5 h-3.5 text-[#FBBF24] group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                Katalog Buku (OPAC)
                            </a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
        
        <!-- Bottom Bar Full Width Darker Blue -->
        <div class="bg-[#111928] py-5 mt-8 relative z-10 border-t border-[#1f2d48]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-[13px] font-medium text-slate-400 text-center md:text-left">
                    &copy; {{ date('Y') }} Perpustakaan Politeknik Keselamatan Transportasi Jalan.<br class="block md:hidden"> Seluruh Hak Cipta Dilindungi.
                </p>
                <div class="flex gap-6 text-[13px] font-medium text-slate-400">
                    <a href="#" class="hover:text-[#FBBF24] transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-[#FBBF24] transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
HTML;

foreach ($files as $file) {
    $path = 'c:/xampp/htdocs/jurnalagregator/' . $file;
    if (file_exists($path)) {
        $content = file_get_contents($path);
        // regex to replace from <!-- Footer --> up to </footer>
        $content = preg_replace('/<!-- Footer -->\s*<footer.*?<\/footer>/s', $newFooter, $content);
        file_put_contents($path, $content);
        echo "Updated $file\n";
    }
}
?>
