<?php

$controllerPath = 'c:/xampp/htdocs/jurnalagregator/app/Http/Controllers/SearchController.php';
$controllerContent = file_get_contents($controllerPath);

$target = "        // Buat custom paginator dari hasil memori";
$replacement = <<<PHP
        if (\$request->has('prefetch')) {
            // Jika request ini hanya untuk prefetch (background loading), hentikan eksekusi di sini.
            // Data sudah berhasil di-cache oleh LiveSearchService di atas, sehingga halaman selanjutnya akan instan!
            return response()->json(['status' => 'prefetched']);
        }

        // Buat custom paginator dari hasil memori
PHP;

if (strpos($controllerContent, "if (\$request->has('prefetch'))") === false) {
    $controllerContent = str_replace($target, $replacement, $controllerContent);
    file_put_contents($controllerPath, $controllerContent);
}

// 2. Update search.blade.php to inject the prefetch javascript
$bladePath = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$bladeContent = file_get_contents($bladePath);

$bladeTarget = "</body>";
$bladeReplacement = <<<HTML
<!-- Smart Background Prefetching -->
    @if(isset(\$articles) && \$articles->total() > 0 && !request()->has('prefetch'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tunggu 3 detik setelah halaman selesai dimuat agar tidak mengganggu kecepatan awal
            setTimeout(() => {
                let currentPage = {{ request('page', 1) }};
                let totalPages = {{ \$articles->lastPage() ?? 1 }};
                
                // Siapkan 4 halaman ke depan secara diam-diam di background
                let maxPrefetch = Math.min(currentPage + 4, totalPages); 
                
                for (let p = currentPage + 1; p <= maxPrefetch; p++) {
                    let url = new URL(window.location.href);
                    url.searchParams.set('page', p);
                    url.searchParams.set('prefetch', '1');
                    
                    fetch(url.toString(), {
                        priority: 'low'
                    }).catch(e => {}); // Abaikan error jika gagal prefetch
                }
            }, 3000);
        });
    </script>
    @endif
</body>
HTML;

if (strpos($bladeContent, "Smart Background Prefetching") === false) {
    $bladeContent = str_replace($bladeTarget, $bladeReplacement, $bladeContent);
    file_put_contents($bladePath, $bladeContent);
}

echo "Smart prefetching implemented.\n";
