<?php

$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/admin/dashboard.blade.php';
$bladeContent = file_get_contents($bladePath);

// 1. Perbaiki JS agar formData tidak hardcode 'filterForm'
$oldJs = <<<JS
            } else {
                const formData = new FormData(document.getElementById('filterForm'));
JS;
$newJs = <<<JS
            } else {
                const formData = new FormData(urlOrForm);
JS;
$bladeContent = str_replace($oldJs, $newJs, $bladeContent);

// 2. Tambahkan form rentang tanggal ke dalam Header Grafik Unduhan
$oldHeader = <<<HTML
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full xl:w-auto">
                                <!-- Filter Database -->
HTML;

$newHeader = <<<HTML
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full xl:w-auto">
                                
                                <!-- Rentang Manual (Sama seperti Grafik Pengunjung) -->
                                <form onsubmit="event.preventDefault(); fetchData(this);" class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Rentang Manual:</span>
                                    <input type="date" name="start_date" value="{{ \$customStart }}" class="dl-start-input text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <span class="text-slate-400">-</span>
                                    <input type="date" name="end_date" value="{{ \$customEnd }}" class="dl-end-input text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500" required>
                                    <button type="submit" class="bg-[#1e293b] hover:bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded transition">Tampilkan</button>
                                </form>
                                
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden md:block">ATAU</span>
                                
                                <!-- Pilih Rentang Dropdown -->
                                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                    <span class="text-xs font-semibold text-slate-500 pl-2">Pilih Rentang:</span>
                                    <select onchange="fetchData('?range='+this.value)" class="dl-range-select text-xs px-2 py-1.5 rounded border border-slate-300 outline-none focus:border-blue-500 bg-white">
                                        <option value="7_days" {{ \$currentFilter === '7_days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                        <option value="1_month" {{ \$currentFilter === '1_month' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                        <option value="6_months" {{ \$currentFilter === '6_months' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                                        <option value="1_year" {{ \$currentFilter === '1_year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                                        <option value="all_time" {{ \$currentFilter === 'all_time' ? 'selected' : '' }}>Sepanjang Waktu</option>
                                        @foreach(\$years as \$year)
                                            <option value="year_{{ \$year }}" {{ \$currentFilter === 'year_'.\$year ? 'selected' : '' }}>Tahun {{ \$year }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filter Database -->
HTML;

$bladeContent = str_replace($oldHeader, $newHeader, $bladeContent);


// 3. Perbarui JS untuk sinkronisasi form Date Inputs di kedua tempat
$oldInputUpdate = <<<JS
                // Update Inputs & Select
                const startInput = document.querySelector('input[name="start_date"]');
                const endInput = document.querySelector('input[name="end_date"]');
                const rangeSelect = document.querySelector('select');
                if (startInput) startInput.value = data.customStart || '';
                if (endInput) endInput.value = data.customEnd || '';
                if (rangeSelect) rangeSelect.value = data.currentFilter || '7_days';
JS;

$newInputUpdate = <<<JS
                // Update All Date Inputs & Selects in the page
                document.querySelectorAll('input[name="start_date"]').forEach(el => el.value = data.customStart || '');
                document.querySelectorAll('input[name="end_date"]').forEach(el => el.value = data.customEnd || '');
                // Update only range selects, not the dbFilter
                document.querySelectorAll('select').forEach(el => {
                    if (el.id !== 'dbFilter') {
                        el.value = data.currentFilter || '7_days';
                    }
                });
JS;
$bladeContent = str_replace($oldInputUpdate, $newInputUpdate, $bladeContent);


file_put_contents($bladePath, $bladeContent);
echo "Berhasil update filter grafik unduhan.\n";

