<?php

$dir = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

// ==========================================
// LOGIN VIEW
// ==========================================
$loginView = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Jurnal Agregator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1e293b] flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-blue-100">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800">Admin Dashboard</h1>
            <p class="text-sm text-slate-500 mt-1">Sistem Agregator Jurnal PKTJ</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4 border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.authenticate') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                <input type="text" name="username" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" required>
            </div>
            <button type="submit" class="w-full bg-[#1e293b] text-white font-bold py-3 px-4 rounded-lg hover:bg-slate-800 transition shadow-lg">
                Masuk Sistem
            </button>
        </form>
    </div>

</body>
</html>
HTML;
file_put_contents($dir . '/login.blade.php', $loginView);


// ==========================================
// DASHBOARD VIEW
// ==========================================
$dashboardView = <<<HTML
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
</head>
<body class="flex h-screen overflow-hidden text-slate-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#1e293b] text-slate-300 flex flex-col transition-all duration-300">
        <div class="p-6 flex items-center justify-center border-b border-slate-700">
            <div class="text-center">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-2">
                    <svg class="w-6 h-6 text-[#1e293b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h2 class="font-bold text-white text-sm tracking-widest">ADMIN PERPUSTAKAAN</h2>
                <p class="text-[10px] text-slate-400">Jurnal Agregator PKTJ</p>
            </div>
        </div>
        
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li class="px-3">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 ml-3">Menu Utama</p>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-white bg-blue-600/20 border-l-4 border-blue-500">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span class="font-medium">Statistik & Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('search.index') }}" target="_blank" class="flex items-center gap-3 px-6 py-3 hover:bg-slate-800 transition">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        <span class="font-medium">Lihat Website</span>
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
                <h1 class="text-2xl font-bold text-slate-800">Statistik Keseluruhan</h1>
            </div>

            <!-- TAB NAVIGASI -->
            <div x-data="{ tab: 'pengunjung' }">
                <div class="flex border-b border-slate-200 mb-6">
                    <button @click="tab = 'pengunjung'" :class="tab === 'pengunjung' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700'" class="px-4 py-2 border-b-2 font-bold transition">Pengunjung & Grafik</button>
                    <button @click="tab = 'unduhan'" :class="tab === 'unduhan' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700'" class="px-4 py-2 border-b-2 font-bold transition">Statistik Unduhan</button>
                    <button @click="tab = 'pencarian'" :class="tab === 'pencarian' ? 'border-blue-500 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700'" class="px-4 py-2 border-b-2 font-bold transition">Pencarian Populer</button>
                </div>

                <!-- TAB: PENGUNJUNG -->
                <div x-show="tab === 'pengunjung'" x-transition.opacity>
                    <!-- KARTU PENGUNJUNG -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-blue-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Hari Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 class="text-3xl font-black text-slate-800">{{ number_format(\$visitors['today']) }}</h3>
                                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-amber-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kemarin</p>
                            <div class="flex items-end justify-between">
                                <h3 class="text-3xl font-black text-slate-800">{{ number_format(\$visitors['yesterday']) }}</h3>
                                <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-emerald-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Bulan Ini</p>
                            <div class="flex items-end justify-between">
                                <h3 class="text-3xl font-black text-slate-800">{{ number_format(\$visitors['month']) }}</h3>
                                <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-purple-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Sepanjang Waktu</p>
                            <div class="flex items-end justify-between">
                                <h3 class="text-3xl font-black text-slate-800">{{ number_format(\$visitors['all_time']) }}</h3>
                                <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CHART -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-slate-800">Grafik Kunjungan (7 Hari Terakhir)</h3>
                        </div>
                        <div id="visitChart" class="w-full h-80"></div>
                    </div>
                </div>

                <!-- TAB: UNDUHAN -->
                <div x-show="tab === 'unduhan'" style="display: none;" x-transition.opacity>
                    <!-- KARTU UNDUHAN -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-blue-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Unduhan Hari Ini</p>
                            <h3 class="text-3xl font-black text-slate-800">{{ number_format(\$downloads['today']) }}</h3>
                        </div>
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-amber-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kemarin</p>
                            <h3 class="text-3xl font-black text-slate-800">{{ number_format(\$downloads['yesterday']) }}</h3>
                        </div>
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-emerald-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Bulan Ini</p>
                            <h3 class="text-3xl font-black text-slate-800">{{ number_format(\$downloads['month']) }}</h3>
                        </div>
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-100 border-b-4 border-b-purple-500">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Total Keseluruhan</p>
                            <h3 class="text-3xl font-black text-slate-800">{{ number_format(\$downloads['all_time']) }}</h3>
                        </div>
                    </div>

                    <!-- TABEL UNDUHAN PER DATABASE -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Peringkat Unduhan per Database (All Time)</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-600">
                                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[11px]">
                                    <tr>
                                        <th class="px-4 py-3 rounded-tl-lg">Peringkat</th>
                                        <th class="px-4 py-3">Database / Sumber</th>
                                        <th class="px-4 py-3 rounded-tr-lg text-right">Total Unduhan / Klik</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\$downloadsPerDatabase as \$index => \$dbLog)
                                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                                        <td class="px-4 py-3 font-bold">#{{ \$index + 1 }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-800">{{ \$dbLog->repository_name }}</td>
                                        <td class="px-4 py-3 text-right font-black text-blue-600">{{ number_format(\$dbLog->total) }}</td>
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
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Top 10 Pencarian Terpopuler</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-600">
                                <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-[11px]">
                                    <tr>
                                        <th class="px-4 py-3 rounded-tl-lg">Peringkat</th>
                                        <th class="px-4 py-3">Kata Kunci (Keyword)</th>
                                        <th class="px-4 py-3 rounded-tr-lg text-right">Total Dicari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\$popularSearches as \$index => \$search)
                                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                                        <td class="px-4 py-3 font-bold">#{{ \$index + 1 }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-800">{{ \$search->query }}</td>
                                        <td class="px-4 py-3 text-right font-black text-purple-600">{{ number_format(\$search->count) }}</td>
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
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    name: 'Pengunjung',
                    data: @json(\$chartVisits)
                }, {
                    name: 'Unduhan/Klik',
                    data: @json(\$chartDownloads)
                }],
                chart: {
                    height: 350,
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
                    categories: @json(\$chartDates),
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

            var chart = new ApexCharts(document.querySelector("#visitChart"), options);
            chart.render();
        });
    </script>
</body>
</html>
HTML;
file_put_contents($dir . '/dashboard.blade.php', $dashboardView);

echo "Admin views created.\n";
?>
