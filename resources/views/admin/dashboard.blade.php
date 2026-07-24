<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Statistik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
    </style>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logodashboard.png') }}">
</head>
<body class="flex h-screen overflow-hidden text-slate-800 bg-slate-50" x-data="{ tab: 'pengunjung' }">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#1e293b] text-slate-300 flex flex-col transition-all duration-300">
        <div class="p-6 flex flex-col items-center justify-center border-b border-slate-700 text-center">
            <!-- Logo Perpustakaan -->
            <img src="{{ asset('logodashboard.png') }}" alt="Logo PKTJ" class="w-20 h-20 object-contain mb-3 drop-shadow-md">
            
            <!-- Teks -->
            <h2 class="text-amber-500 font-black text-sm tracking-widest uppercase leading-tight">ADMIN PERPUSTAKAAN</h2>
            <p class="text-white text-[11px] font-medium tracking-wide mt-1 leading-tight">Agregator Jurnal</p>
        </div>
        
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li class="px-3">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 ml-3">Menu Laporan</p>
                </li>
                <li>
                    <a href="#" @click.prevent="tab = 'pengunjung'" :class="tab === 'pengunjung' ? 'bg-blue-600/20 border-l-4 border-blue-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-300 border-l-4 border-transparent'" class="flex items-center gap-3 px-6 py-3 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="font-medium">Statistik Pengunjung</span>
                    </a>
                </li>
                <li>
                    <a href="#" @click.prevent="tab = 'unduhan'" :class="tab === 'unduhan' ? 'bg-blue-600/20 border-l-4 border-blue-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-300 border-l-4 border-transparent'" class="flex items-center gap-3 px-6 py-3 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span class="font-medium">Statistik Download</span>
                    </a>
                </li>
                <li>
                    <a href="#" @click.prevent="tab = 'pencarian'" :class="tab === 'pencarian' ? 'bg-blue-600/20 border-l-4 border-blue-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-300 border-l-4 border-transparent'" class="flex items-center gap-3 px-6 py-3 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="font-medium">Pencarian Populer</span>
                    </a>
                </li>
                <li class="px-3 mt-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 ml-3">Website</p>
                </li>
                <li>
                    <a href="{{ route('search.index') }}" target="_blank" class="flex items-center gap-3 px-6 py-3 text-slate-400 border-l-4 border-transparent hover:bg-slate-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        <span class="font-medium">Lihat Website Utama</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
        <!-- Header -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shrink-0">
            <div class="flex items-center gap-2 text-sm font-medium text-slate-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ date('d M Y, H:i') }}</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-sm font-bold text-slate-700">
                    <div class="w-8 h-8 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    Halo, Admin
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Scrollable Area -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6">
            
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                <h1 class="text-2xl font-bold text-slate-800" x-text="tab === 'pengunjung' ? 'Statistik Pengunjung Keseluruhan' : (tab === 'unduhan' ? 'Statistik Unduhan Keseluruhan' : 'Statistik Pencarian Keseluruhan')">Statistik Keseluruhan</h1>
            </div>

            <!-- TAB NAVIGASI (Dihapus karena sudah dipindah ke Sidebar) -->
            <div>
                <!-- TAB: PENGUNJUNG -->
                <div x-show="tab === 'pengunjung'" x-transition.opacity>
                    <!-- KARTU PENGUNJUNG -->
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-blue-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Hari Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-vis-today" class="text-3xl font-black text-slate-800">{{ number_format($visitors['today']) }}</h3>
                                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-amber-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kemarin</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-vis-yesterday" class="text-3xl font-black text-slate-800">{{ number_format($visitors['yesterday']) }}</h3>
                                <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-emerald-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Bulan Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-vis-month" class="text-3xl font-black text-slate-800">{{ number_format($visitors['month']) }}</h3>
                                <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-purple-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Sepanjang Waktu</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-vis-all" class="text-3xl font-black text-slate-800">{{ number_format($visitors['all_time']) }}</h3>
                                <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CHART -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-6 gap-4">
                            <h3 class="text-lg font-bold text-slate-800 shrink-0">Grafik Kunjungan & Unduhan</h3>
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full xl:w-auto">
                                <!-- Rentang Manual -->
                                <form id="filterForm" onsubmit="event.preventDefault(); fetchData(this);" class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Rentang Manual:</span>
                                    <input type="date" name="start_date" value="{{ $customStart }}" class="text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <span class="text-slate-400">-</span>
                                    <input type="date" name="end_date" value="{{ $customEnd }}" class="text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <button type="submit" class="bg-[#1e293b] hover:bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded transition">Tampilkan</button>
                                </form>
                                
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden md:block">ATAU</span>
                                
                                <!-- Pilih Rentang Dropdown -->
                                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Pilih Rentang:</span>
                                    <select onchange="fetchData('?range='+this.value)" class="text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500 bg-white">
                                        <option value="7_days" {{ $currentFilter === '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                        <option value="1_month" {{ $currentFilter === '1_month' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                        <option value="6_months" {{ $currentFilter === '6_months' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                                        <option value="1_year" {{ $currentFilter === '1_year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                                        <option value="all_time" {{ $currentFilter === 'all_time' ? 'selected' : '' }}>Sepanjang Waktu</option>
                                        @foreach($years as $year)
                                            <option value="year_{{ $year }}" {{ $currentFilter === 'year_'.$year ? 'selected' : '' }}>Tahun {{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="visitChart" class="w-full h-96"></div>
                    </div>
                </div>

                <!-- TAB: UNDUHAN -->
                <div x-show="tab === 'unduhan'" style="display: none;" x-transition.opacity>
                    <!-- KARTU UNDUHAN -->
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-blue-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Hari Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-dl-today" class="text-3xl font-black text-slate-800">{{ number_format($downloads['today']) }}</h3>
                                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-amber-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kemarin</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-dl-yesterday" class="text-3xl font-black text-slate-800">{{ number_format($downloads['yesterday']) }}</h3>
                                <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-emerald-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Bulan Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-dl-month" class="text-3xl font-black text-slate-800">{{ number_format($downloads['month']) }}</h3>
                                <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-purple-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Sepanjang Waktu</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-dl-all" class="text-3xl font-black text-slate-800">{{ number_format($downloads['all_time']) }}</h3>
                                <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CHART UNDUHAN -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 mb-6">
                        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-6 gap-4">
                            <h3 class="text-lg font-bold text-slate-800 shrink-0">Grafik Unduhan</h3>
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full xl:w-auto">
                                
                                <!-- Rentang Manual (Sama seperti Grafik Pengunjung) -->
                                <form onsubmit="event.preventDefault(); fetchData(this);" class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Rentang Manual:</span>
                                    <input type="date" name="start_date" value="{{ $customStart }}" class="dl-start-input text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <span class="text-slate-400">-</span>
                                    <input type="date" name="end_date" value="{{ $customEnd }}" class="dl-end-input text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <button type="submit" class="bg-[#1e293b] hover:bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded transition">Tampilkan</button>
                                </form>
                                
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden md:block">ATAU</span>
                                
                                <!-- Pilih Rentang Dropdown -->
                                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Pilih Rentang:</span>
                                    <select onchange="fetchData('?range='+this.value)" class="dl-range-select text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500 bg-white">
                                        <option value="7_days" {{ $currentFilter === '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                        <option value="1_month" {{ $currentFilter === '1_month' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                        <option value="6_months" {{ $currentFilter === '6_months' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                                        <option value="1_year" {{ $currentFilter === '1_year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                                        <option value="all_time" {{ $currentFilter === 'all_time' ? 'selected' : '' }}>Sepanjang Waktu</option>
                                        @foreach($years as $year)
                                            <option value="year_{{ $year }}" {{ $currentFilter === 'year_'.$year ? 'selected' : '' }}>Tahun {{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filter Database -->
                                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Pilih Database:</span>
                                    <select id="dbFilter" onchange="fetchData('?db='+this.value)" class="text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500 bg-white">
                                        <option value="all" {{ $dbFilter === 'all' ? 'selected' : '' }}>Semua Database</option>
                                        @foreach($databases as $dbName)
                                            <option value="{{ $dbName }}" {{ $dbFilter === $dbName ? 'selected' : '' }}>{{ $dbName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="downloadChart" class="w-full h-96"></div>
                    </div>

                    <!-- TABEL UNDUHAN PER DATABASE -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Peringkat Unduhan per Database (Berdasarkan Rentang Waktu)</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-600">
                                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[11px]">
                                    <tr>
                                        <th class="px-4 py-3 rounded-tl-lg">Peringkat</th>
                                        <th class="px-4 py-3">Database / Sumber</th>
                                        <th class="px-4 py-3 rounded-tr-lg text-right">Total Unduhan / Klik</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-db-ranking">
                                    @forelse($downloadsPerDatabase as $index => $dbLog)
                                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                                        <td class="px-4 py-3 font-bold">#{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-800">{{ $dbLog->repository_name }}</td>
                                        <td class="px-4 py-3 text-right font-black text-blue-600">{{ number_format($dbLog->total) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-8 text-center text-slate-500">Belum ada data unduhan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TAB: PENCARIAN POPULER -->
                <div x-show="tab === 'pencarian'" style="display: none;" x-transition.opacity>
                    
                    <!-- KARTU PENCARIAN -->
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-blue-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Hari Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-search-today" class="text-3xl font-black text-slate-800">{{ number_format($searchesStats['today']) }}</h3>
                                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-amber-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kemarin</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-search-yesterday" class="text-3xl font-black text-slate-800">{{ number_format($searchesStats['yesterday']) }}</h3>
                                <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-emerald-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Bulan Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-search-month" class="text-3xl font-black text-slate-800">{{ number_format($searchesStats['month']) }}</h3>
                                <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-purple-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Sepanjang Waktu</p>
                            <div class="flex items-end justify-between">
                                <h3 id="val-search-all" class="text-3xl font-black text-slate-800">{{ number_format($searchesStats['all_time']) }}</h3>
                                <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CHART PENCARIAN -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 mb-6">
                        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-6 gap-4">
                            <h3 class="text-lg font-bold text-slate-800 shrink-0">Grafik Volume Pencarian</h3>
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full xl:w-auto">
                                
                                <!-- Rentang Manual -->
                                <form onsubmit="event.preventDefault(); fetchData(this);" class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Rentang Manual:</span>
                                    <input type="date" name="start_date" value="{{ $customStart }}" class="dl-start-input text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <span class="text-slate-400">-</span>
                                    <input type="date" name="end_date" value="{{ $customEnd }}" class="dl-end-input text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <button type="submit" class="bg-[#1e293b] hover:bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded transition">Tampilkan</button>
                                </form>
                                
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden md:block">ATAU</span>
                                
                                <!-- Pilih Rentang Dropdown -->
                                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Pilih Rentang:</span>
                                    <select onchange="fetchData('?range='+this.value)" class="dl-range-select text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500 bg-white">
                                        <option value="7_days" {{ $currentFilter === '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                        <option value="1_month" {{ $currentFilter === '1_month' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                        <option value="6_months" {{ $currentFilter === '6_months' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                                        <option value="1_year" {{ $currentFilter === '1_year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                                        <option value="all_time" {{ $currentFilter === 'all_time' ? 'selected' : '' }}>Sepanjang Waktu</option>
                                        @foreach($years as $year)
                                            <option value="year_{{ $year }}" {{ $currentFilter === 'year_'.$year ? 'selected' : '' }}>Tahun {{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="searchChart" class="w-full h-96"></div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Top 20 Pencarian Terpopuler</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-600">
                                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[11px]">
                                    <tr>
                                        <th class="px-4 py-3 rounded-tl-lg">Peringkat</th>
                                        <th class="px-4 py-3">Kata Kunci (Keyword)</th>
                                        <th class="px-4 py-3 rounded-tr-lg text-right">Total Dicari</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-popular-searches">
                                    @forelse($popularSearches as $index => $search)
                                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                                        <td class="px-4 py-3 font-bold">#{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-800 capitalize">{{ $search->keyword }}</td>
                                        <td class="px-4 py-3 text-right font-black text-purple-600">{{ number_format($search->count) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-8 text-center text-slate-500">Belum ada data pencarian.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div> <!-- End Tab System -->
            
        </div>
    </main>

    

    <script>
        // Init ApexCharts
        var chartOptions = {
            series: [{
                name: 'Pengunjung',
                data: @json($chartVisits)
            }, {
                name: 'Unduhan/Klik',
                data: @json($chartDownloads)
            }],
            chart: {
                height: 380,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#3b82f6', '#10b981'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: @json($chartDates),
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                min: 0,
                forceNiceScale: true
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
            }
        };

        var visitChart = new ApexCharts(document.querySelector("#visitChart"), chartOptions);
        visitChart.render();

        // Init ApexCharts Search
        var searchChartOptions = {
            series: [{
                name: 'Pencarian',
                data: @json($chartSearches)
            }],
            chart: {
                height: 380,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#a855f7'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            fill: {
                type: 'gradient',
                gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 90, 100] }
            },
            xaxis: {
                categories: @json($chartDates),
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: { min: 0, forceNiceScale: true },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 }
        };
        var searchChart = new ApexCharts(document.querySelector("#searchChart"), searchChartOptions);
        searchChart.render();

        // Init ApexCharts Download (Multi-Line)
        var dlChartOptions = {
            series: @json($formattedSeries),
            chart: {
                height: 380,
                type: 'line',
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4', '#14b8a6'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: @json($chartDates),
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: { min: 0, forceNiceScale: true },
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
            tooltip: {
                shared: true,
                intersect: false,
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right'
            }
        };
        var downloadChart = new ApexCharts(document.querySelector("#downloadChart"), dlChartOptions);
        downloadChart.render();

        // AJAX Fetching Data
        function fetchData(urlOrForm) {
            let urlObj = new URL(window.location.origin + window.location.pathname);
            const dbFilter = document.getElementById('dbFilter');
            const currentUrlParams = new URLSearchParams(window.location.search);
            
            if (typeof urlOrForm === 'string') {
                const incomingParams = new URLSearchParams(urlOrForm.replace('?', ''));
                
                // Merge parameters: if incoming has range, clear start/end date.
                if (incomingParams.has('range')) {
                    urlObj.searchParams.set('range', incomingParams.get('range'));
                } else if (currentUrlParams.has('range')) {
                    urlObj.searchParams.set('range', currentUrlParams.get('range'));
                } else if (currentUrlParams.has('start_date')) {
                    urlObj.searchParams.set('start_date', currentUrlParams.get('start_date'));
                    urlObj.searchParams.set('end_date', currentUrlParams.get('end_date'));
                }
                
                // Set DB filter
                if (incomingParams.has('db')) {
                    urlObj.searchParams.set('db', incomingParams.get('db'));
                } else if (dbFilter) {
                    urlObj.searchParams.set('db', dbFilter.value);
                }
            } else {
                const formData = new FormData(urlOrForm);
                for(let [key, value] of formData.entries()) {
                    urlObj.searchParams.set(key, value);
                }
                if (dbFilter) urlObj.searchParams.set('db', dbFilter.value);
            }
            
            let url = urlObj.toString();
            
            // Visual feedback loading
            document.body.style.cursor = 'wait';
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                const formatter = new Intl.NumberFormat('id-ID');
                
                // Update Visitors
                document.getElementById('val-vis-today').innerText = formatter.format(data.visitors.today);
                document.getElementById('val-vis-yesterday').innerText = formatter.format(data.visitors.yesterday);
                document.getElementById('val-vis-month').innerText = formatter.format(data.visitors.month);
                document.getElementById('val-vis-all').innerText = formatter.format(data.visitors.all_time);
                
                // Update Downloads
                document.getElementById('val-dl-today').innerText = formatter.format(data.downloads.today);
                document.getElementById('val-dl-yesterday').innerText = formatter.format(data.downloads.yesterday);
                document.getElementById('val-dl-month').innerText = formatter.format(data.downloads.month);
                document.getElementById('val-dl-all').innerText = formatter.format(data.downloads.all_time);

                // Update Database Table
                let dbHtml = '';
                if(data.downloadsPerDatabase.length > 0) {
                    data.downloadsPerDatabase.forEach((item, index) => {
                        dbHtml += `<tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="px-4 py-3 font-bold">#${index + 1}</td>
                            <td class="px-4 py-3 font-semibold text-slate-800">${item.repository_name}</td>
                            <td class="px-4 py-3 text-right font-black text-blue-600">${formatter.format(item.total)}</td>
                        </tr>`;
                    });
                } else {
                    dbHtml = `<tr><td colspan="3" class="px-4 py-8 text-center text-slate-500">Belum ada data unduhan.</td></tr>`;
                }
                document.getElementById('tbody-db-ranking').innerHTML = dbHtml;

                // Update Searches Table
                let searchHtml = '';
                if(data.popularSearches.length > 0) {
                    data.popularSearches.forEach((item, index) => {
                        searchHtml += `<tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="px-4 py-3 font-bold">#${index + 1}</td>
                            <td class="px-4 py-3 font-semibold text-slate-800 capitalize">${item.keyword}</td>
                            <td class="px-4 py-3 text-right font-black text-purple-600">${formatter.format(item.count)}</td>
                        </tr>`;
                    });
                } else {
                    searchHtml = `<tr><td colspan="3" class="px-4 py-8 text-center text-slate-500">Belum ada data pencarian.</td></tr>`;
                }
                document.getElementById('tbody-popular-searches').innerHTML = searchHtml;

                // Update All Date Inputs & Selects in the page
                document.querySelectorAll('input[name="start_date"]').forEach(el => el.value = data.customStart || '');
                document.querySelectorAll('input[name="end_date"]').forEach(el => el.value = data.customEnd || '');
                // Update only range selects, not the dbFilter
                document.querySelectorAll('select').forEach(el => {
                    if (el.id !== 'dbFilter') {
                        el.value = data.currentFilter || '7_days';
                    }
                });

                // Update Chart
                visitChart.updateSeries([
                    { name: 'Pengunjung', data: data.chartVisits },
                    { name: 'Unduhan/Klik', data: data.chartDownloads }
                ]);
                visitChart.updateOptions({
                    xaxis: { categories: data.chartDates }
                });
                
                downloadChart.updateSeries(data.chartDownloadsSeries);
                downloadChart.updateOptions({
                    xaxis: { categories: data.chartDates }
                });
                
                if (data.chartSearches) {
                    searchChart.updateSeries([
                        { name: 'Pencarian', data: data.chartSearches }
                    ]);
                    searchChart.updateOptions({
                        xaxis: { categories: data.chartDates }
                    });
                }
                
                if (document.getElementById('dbFilter') && data.dbFilter) {
                    document.getElementById('dbFilter').value = data.dbFilter;
                }
                
                // Update URL in browser smoothly without reload
                window.history.pushState({}, '', url);
            })
            .catch(error => {
                console.error("Gagal mengambil data statistik:", error);
            })
            .finally(() => {
                document.body.style.cursor = 'default';
            });
        }
    </script>
</body>
</html>