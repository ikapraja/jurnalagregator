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
    <footer class="relative bg-[#1E3A8A] border-t border-blue-900 pt-16 mt-auto text-white overflow-hidden">
        <!-- Radial Dot Background -->
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mb-16">
            <!-- Grid 12 Kolom untuk distribusi jarak yang natural dan proporsional -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8">
                
                <!-- Column 1: Brand & Desc -->
                <div class="flex flex-col gap-6 md:col-span-5 lg:col-span-5">
                    <div class="flex items-center gap-3">
                        <!-- Menghapus kotak putih (card) pada logo -->
                        <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-12 w-auto object-contain" onerror="this.outerHTML='<div class=\'w-12 h-12 bg-transparent border border-white/30 rounded-xl flex items-center justify-center text-white font-bold text-2xl\'>P</div>'">
                        <div class="flex flex-col">
                            <h2 class="text-xl font-extrabold text-white tracking-tight leading-tight">PERPUSTAKAAN PKTJ</h2>
                        </div>
                    </div>
                    <p class="text-[14px] font-medium text-blue-100/80 leading-relaxed text-justify lg:pr-12">
                        Agregator Jurnal Perpustakaan PKTJ membantu mahasiswa, dosen, peneliti, dan masyarakat menemukan referensi ilmiah dari berbagai database akademik terpercaya melalui satu pencarian.
                    </p>
                </div>
                
                <!-- Column 2: Navigasi -->
                <div class="flex flex-col gap-6 md:col-span-3 lg:col-span-3 lg:pl-6">
                    <h3 class="text-base font-bold text-white uppercase tracking-wider">Navigasi</h3>
                    <ul class="flex flex-col gap-4">
                        <li><a href="{{ route('search.index') }}" class="text-[14px] font-medium text-blue-100/80 hover:text-[#FBBF24] hover:translate-x-1 inline-block transition-transform duration-200">Beranda</a></li>
                        <li><a href="{{ route('how-to-use') }}" class="text-[14px] font-medium text-blue-100/80 hover:text-[#FBBF24] hover:translate-x-1 inline-block transition-transform duration-200">Cara Menggunakan</a></li>
                        <li><a href="{{ route('faq') }}" class="text-[14px] font-medium text-blue-100/80 hover:text-[#FBBF24] hover:translate-x-1 inline-block transition-transform duration-200">FAQ</a></li>
                        <li><a href="{{ route('about') }}" class="text-[14px] font-medium text-blue-100/80 hover:text-[#FBBF24] hover:translate-x-1 inline-block transition-transform duration-200">Tentang</a></li>
                        <li>
                            <a href="https://library.pktj.ac.id/" target="_blank" rel="noopener noreferrer" class="text-[14px] font-medium text-blue-100/80 hover:text-[#FBBF24] hover:translate-x-1 inline-flex items-center gap-1.5 transition-transform duration-200">
                                Website Perpustakaan PKTJ
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Column 3: Hubungi Kami -->
                <div class="flex flex-col gap-6 md:col-span-4 lg:col-span-4 lg:pl-8">
                    <h3 class="text-base font-bold text-white uppercase tracking-wider">Hubungi Kami</h3>
                    <ul class="flex flex-col gap-5">
                        <li class="flex items-start gap-3 text-[14px] font-medium text-blue-100/80">
                            <svg class="w-5 h-5 text-blue-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            library@pktj.ac.id
                        </li>
                        <li class="flex items-start gap-3 text-[14px] font-medium text-blue-100/80">
                            <svg class="w-5 h-5 text-blue-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            (0283) 351061
                        </li>
                        <li class="flex items-start gap-3 text-[14px] font-medium text-blue-100/80">
                            <svg class="w-5 h-5 text-blue-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="leading-relaxed">
                                Perpustakaan PKTJ<br>
                                Jl. Abdul Syukur No.17<br>
                                Margadana<br>
                                Kota Tegal<br>
                                Jawa Tengah
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Bottom Bar Full Width Darker Blue -->
        <div class="bg-[#172554] py-6 relative z-10 border-t border-blue-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-[13px] font-medium text-blue-200/60 text-center md:text-left">
                    &copy; {{ date('Y') }} Perpustakaan Politeknik Keselamatan Transportasi Jalan.<br class="block md:hidden"> Seluruh Hak Cipta Dilindungi.
                </p>
                <div class="flex gap-6 text-[13px] font-medium text-blue-200/60">
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
