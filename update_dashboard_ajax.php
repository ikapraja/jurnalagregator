<?php

$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$bladeContent = file_get_contents($bladePath);

// 1. Ubah Form dan Select untuk menggunakan AJAX
$bladeContent = str_replace(
    '<form action="{{ route(\'admin.dashboard\') }}" method="GET"',
    '<form id="filterForm" onsubmit="event.preventDefault(); fetchData(this);"',
    $bladeContent
);
$bladeContent = str_replace(
    'onchange="window.location.href=\'?range=\'+this.value"',
    'onchange="fetchData(\'?range=\'+this.value)"',
    $bladeContent
);

// 2. Tambahkan ID pada angka pengunjung
$bladeContent = str_replace('<h3 class="text-3xl font-black text-slate-800">{{ number_format($visitors[\'today\']) }}</h3>', '<h3 id="val-vis-today" class="text-3xl font-black text-slate-800">{{ number_format($visitors[\'today\']) }}</h3>', $bladeContent);
$bladeContent = str_replace('<h3 class="text-3xl font-black text-slate-800">{{ number_format($visitors[\'yesterday\']) }}</h3>', '<h3 id="val-vis-yesterday" class="text-3xl font-black text-slate-800">{{ number_format($visitors[\'yesterday\']) }}</h3>', $bladeContent);
$bladeContent = str_replace('<h3 class="text-3xl font-black text-slate-800">{{ number_format($visitors[\'month\']) }}</h3>', '<h3 id="val-vis-month" class="text-3xl font-black text-slate-800">{{ number_format($visitors[\'month\']) }}</h3>', $bladeContent);
$bladeContent = str_replace('<h3 class="text-3xl font-black text-slate-800">{{ number_format($visitors[\'all_time\']) }}</h3>', '<h3 id="val-vis-all" class="text-3xl font-black text-slate-800">{{ number_format($visitors[\'all_time\']) }}</h3>', $bladeContent);

// 3. Tambahkan ID pada angka unduhan
$bladeContent = str_replace('<h3 class="text-3xl font-black text-slate-800">{{ number_format($downloads[\'today\']) }}</h3>', '<h3 id="val-dl-today" class="text-3xl font-black text-slate-800">{{ number_format($downloads[\'today\']) }}</h3>', $bladeContent);
$bladeContent = str_replace('<h3 class="text-3xl font-black text-slate-800">{{ number_format($downloads[\'yesterday\']) }}</h3>', '<h3 id="val-dl-yesterday" class="text-3xl font-black text-slate-800">{{ number_format($downloads[\'yesterday\']) }}</h3>', $bladeContent);
$bladeContent = str_replace('<h3 class="text-3xl font-black text-slate-800">{{ number_format($downloads[\'month\']) }}</h3>', '<h3 id="val-dl-month" class="text-3xl font-black text-slate-800">{{ number_format($downloads[\'month\']) }}</h3>', $bladeContent);
$bladeContent = str_replace('<h3 class="text-3xl font-black text-slate-800">{{ number_format($downloads[\'all_time\']) }}</h3>', '<h3 id="val-dl-all" class="text-3xl font-black text-slate-800">{{ number_format($downloads[\'all_time\']) }}</h3>', $bladeContent);

// 4. Tambahkan ID pada tabel
$bladeContent = str_replace('<tbody>', '<tbody id="tbody-db-ranking">', $bladeContent);
// Perlu hati-hati karena ada 2 tbody. Gunakan preg_replace dengan limit atau cari blok spesifik.
$bladeContent = preg_replace('/<tbody>/', '<tbody id="tbody-db-ranking">', $bladeContent, 1);
$bladeContent = preg_replace('/<tbody>/', '<tbody id="tbody-popular-searches">', $bladeContent, 1);

// 5. Inject JavaScript fetchData
$js = <<<HTML

    <script>
        // Init ApexCharts
        var chartOptions = {
            series: [{
                name: 'Pengunjung',
                data: @json(\$chartVisits)
            }, {
                name: 'Unduhan/Klik',
                data: @json(\$chartDownloads)
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

        var visitChart = new ApexCharts(document.querySelector("#visitChart"), chartOptions);
        visitChart.render();

        // AJAX Fetching Data
        function fetchData(urlOrForm) {
            let url = '';
            if (typeof urlOrForm === 'string') {
                url = urlOrForm;
            } else {
                const formData = new FormData(urlOrForm);
                const params = new URLSearchParams(formData);
                url = '?' + params.toString();
            }
            
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
                            <td class="px-4 py-3 font-bold">#\${index + 1}</td>
                            <td class="px-4 py-3 font-semibold text-slate-800">\${item.repository_name}</td>
                            <td class="px-4 py-3 text-right font-black text-blue-600">\${formatter.format(item.total)}</td>
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
                            <td class="px-4 py-3 font-bold">#\${index + 1}</td>
                            <td class="px-4 py-3 font-semibold text-slate-800">\${item.query}</td>
                            <td class="px-4 py-3 text-right font-black text-purple-600">\${formatter.format(item.count)}</td>
                        </tr>`;
                    });
                } else {
                    searchHtml = `<tr><td colspan="3" class="px-4 py-8 text-center text-slate-500">Belum ada data pencarian.</td></tr>`;
                }
                document.getElementById('tbody-popular-searches').innerHTML = searchHtml;

                // Update Chart
                visitChart.updateSeries([
                    { name: 'Pengunjung', data: data.chartVisits },
                    { name: 'Unduhan/Klik', data: data.chartDownloads }
                ]);
                visitChart.updateOptions({
                    xaxis: { categories: data.chartDates }
                });
                
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
HTML;

// Buang tag script lama
$bladeContent = preg_replace('/<script>[\s\S]*?var chart = new ApexCharts[\s\S]*?<\/script>/', '', $bladeContent);
// Ubah id visitChart jika sebelumnya id nya beda
$bladeContent = str_replace('</body>', $js, $bladeContent);

file_put_contents($bladePath, $bladeContent);
echo "Dashboard Blade updated for AJAX.\n";
