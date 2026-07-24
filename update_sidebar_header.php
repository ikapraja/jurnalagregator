<?php

$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$content = file_get_contents($bladePath);

$oldHeader = <<<HTML
        <!-- Sidebar Header -->
        <div class="h-20 flex flex-col items-center justify-center border-b border-slate-700/50 shrink-0">
            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-[#1e293b] mb-1 shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h1 class="text-white font-black text-sm tracking-widest uppercase">Admin Perpustakaan</h1>
            <p class="text-blue-300 text-[10px] font-medium tracking-wider">Jurnal Agregator PKTJ</p>
        </div>
HTML;

$newHeader = <<<HTML
        <!-- Sidebar Header -->
        <div class="py-6 flex flex-col items-center justify-center border-b border-slate-700/50 shrink-0">
            <!-- Logo Perpustakaan -->
            <img src="{{ asset('logo.png') }}" alt="Logo PKTJ" class="w-16 h-16 object-contain mb-3 drop-shadow-md">
            
            <!-- Teks -->
            <h1 class="text-amber-500 font-black text-sm tracking-widest uppercase text-center leading-tight">ADMIN PERPUSTAKAAN</h1>
            <p class="text-white text-[11px] font-medium tracking-wide text-center mt-1 px-4 leading-tight">Politeknik Keselamatan Transportasi Jalan</p>
        </div>
HTML;

$content = str_replace($oldHeader, $newHeader, $content);

file_put_contents($bladePath, $content);
echo "Sidebar header updated.\n";
