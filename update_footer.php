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
    <footer class="bg-[#F8FAFC] border-t border-slate-200 pt-16 pb-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-8 mb-16">
                <!-- Column 1: Brand & Desc -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="h-12 w-auto object-contain" onerror="this.outerHTML='<div class=\'w-12 h-12 bg-[#1E3A8A] rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow-sm\'>P</div>'">
                        <div class="flex flex-col">
                            <h2 class="text-xl font-extrabold text-[#1E3A8A] tracking-tight leading-tight">PERPUSTAKAAN PKTJ</h2>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-slate-500 leading-relaxed text-justify">
                        Agregator Jurnal Perpustakaan PKTJ membantu mahasiswa, dosen, peneliti, dan masyarakat menemukan referensi ilmiah dari berbagai database akademik terpercaya melalui satu pencarian.
                    </p>
                    <div class="flex flex-col gap-1 mt-2">
                        <p class="text-sm font-bold text-slate-800">Politeknik Keselamatan Transportasi Jalan</p>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kementerian Perhubungan Republik Indonesia</p>
                    </div>
                </div>
                
                <!-- Column 2: Navigasi -->
                <div class="flex flex-col gap-6 lg:px-8">
                    <h3 class="text-base font-bold text-slate-900 uppercase tracking-wider">Navigasi</h3>
                    <ul class="flex flex-col gap-4">
                        <li><a href="{{ route('search.index') }}" class="text-sm font-medium text-slate-500 hover:text-[#1E3A8A] hover:translate-x-1 inline-block transition-transform duration-200">Beranda</a></li>
                        <li><a href="{{ route('how-to-use') }}" class="text-sm font-medium text-slate-500 hover:text-[#1E3A8A] hover:translate-x-1 inline-block transition-transform duration-200">Cara Menggunakan</a></li>
                        <li><a href="{{ route('faq') }}" class="text-sm font-medium text-slate-500 hover:text-[#1E3A8A] hover:translate-x-1 inline-block transition-transform duration-200">FAQ</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm font-medium text-slate-500 hover:text-[#1E3A8A] hover:translate-x-1 inline-block transition-transform duration-200">Tentang</a></li>
                        <li>
                            <a href="https://library.pktj.ac.id/" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-slate-500 hover:text-[#1E3A8A] hover:translate-x-1 inline-flex items-center gap-1.5 transition-transform duration-200">
                                Website Perpustakaan PKTJ
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Column 3: Hubungi Kami -->
                <div class="flex flex-col gap-6">
                    <h3 class="text-base font-bold text-slate-900 uppercase tracking-wider">Hubungi Kami</h3>
                    <ul class="flex flex-col gap-5">
                        <li class="flex items-start gap-3 text-sm font-medium text-slate-500">
                            <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            library@pktj.ac.id
                        </li>
                        <li class="flex items-start gap-3 text-sm font-medium text-slate-500">
                            <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            (0283) 351061
                        </li>
                        <li class="flex items-start gap-3 text-sm font-medium text-slate-500">
                            <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
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
            
            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm font-medium text-slate-500 text-center md:text-left">
                    &copy; {{ date('Y') }} Perpustakaan Politeknik Keselamatan Transportasi Jalan.<br class="block md:hidden"> Seluruh Hak Cipta Dilindungi.
                </p>
                <div class="flex gap-6 text-sm font-bold text-slate-400">
                    <a href="#" class="hover:text-[#1E3A8A] transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-[#1E3A8A] transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
HTML;

foreach ($files as $file) {
    $path = 'c:/xampp/htdocs/jurnalagregator/' . $file;
    if (file_exists($path)) {
        $content = file_get_contents($path);
        $content = preg_replace('/<!-- Footer -->\s*<footer.*?<\/footer>/s', $newFooter, $content);
        file_put_contents($path, $content);
        echo "Updated $file\n";
    }
}
?>
