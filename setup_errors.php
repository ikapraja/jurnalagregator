<?php

$errorsDir = 'c:/xampp/htdocs/jurnalagregator/resources/views/errors';
if (!is_dir($errorsDir)) {
    mkdir($errorsDir, 0755, true);
}

$layout = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error {{ \$code }} - Agregator Jurnal PKTJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logodashboard.png') }}">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-xl overflow-hidden relative border border-slate-100">
        <!-- Dekorasi Background -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-blue-50 opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 rounded-full bg-amber-50 opacity-50"></div>
        
        <div class="relative z-10 p-8 sm:p-12 text-center">
            <img src="{{ asset('logodashboard.png') }}" alt="Logo PKTJ" class="h-20 w-auto mx-auto mb-8 drop-shadow-sm">
            
            <div class="inline-block bg-[#1E3A8A] text-white font-black text-6xl tracking-tighter px-6 py-2 rounded-2xl mb-6 shadow-md rotate-[-2deg]">
                {{ \$code }}
            </div>
            
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 mb-4">{{ \$title }}</h1>
            
            <p class="text-slate-500 mb-10 max-w-md mx-auto leading-relaxed">{{ \$message }}</p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('search.index') }}" class="w-full sm:w-auto bg-[#1E3A8A] hover:bg-blue-900 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Kembali ke Beranda
                </a>
                <button onclick="history.back()" class="w-full sm:w-auto bg-white hover:bg-slate-50 text-slate-700 font-bold py-3 px-8 rounded-xl border border-slate-200 transition shadow-sm flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Halaman Sebelumnya
                </button>
            </div>
        </div>
        
        <!-- Footer Pita Kuning -->
        <div class="h-2 bg-[#FBBF24] w-full"></div>
    </div>
</body>
</html>
HTML;

$errors = [
    '404' => [
        'title' => 'Halaman Tidak Ditemukan',
        'message' => 'Maaf, halaman atau jurnal yang Anda cari mungkin telah dihapus, diubah namanya, atau memang tidak pernah ada.'
    ],
    '500' => [
        'title' => 'Kesalahan Sistem Internal',
        'message' => 'Ups! Sistem kami sedang mengalami gangguan internal. Tim teknisi kami telah diberitahu dan sedang memperbaikinya.'
    ],
    '403' => [
        'title' => 'Akses Ditolak',
        'message' => 'Maaf, Anda tidak memiliki izin yang cukup untuk mengakses halaman atau fitur ini.'
    ],
    '419' => [
        'title' => 'Sesi Kedaluwarsa',
        'message' => 'Halaman ini telah kedaluwarsa karena Anda terlalu lama tidak beraktivitas. Silakan muat ulang (refresh) halaman.'
    ],
    '429' => [
        'title' => 'Terlalu Banyak Permintaan',
        'message' => 'Anda telah melakukan terlalu banyak pencarian dalam waktu singkat. Mohon tunggu beberapa saat sebelum mencoba lagi.'
    ]
];

foreach ($errors as $code => $data) {
    $content = str_replace(
        ['{{ $code }}', '{{ $title }}', '{{ $message }}'],
        [$code, $data['title'], $data['message']],
        $layout
    );
    // Escape the blade syntax so it parses in blade properly
    // Wait, the layout uses {{ route('search.index') }} and {{ asset(...) }}. Those should remain Blade syntax!
    // So the str_replace for $code, $title, $message is fine. We just need to make sure $code doesn't get messed up.
    file_put_contents("$errorsDir/$code.blade.php", $content);
}

// 2. We also need to configure Laravel to use these custom error views instead of debug mode,
// BUT Laravel only shows custom 500 errors when APP_DEBUG=false.
// The user saw the Laravel error page because APP_DEBUG=true.
// I will temporarily update .env to APP_DEBUG=false so they can see the custom error pages?
// No, it's better to keep APP_DEBUG=true during development, but I can show them how to see it,
// or I can create a route to preview the error pages.
$routesPath = 'c:/xampp/htdocs/jurnalagregator/routes/web.php';
$routesContent = file_get_contents($routesPath);

if (strpos($routesContent, '/error-preview') === false) {
    $previewRoute = <<<PHP

// Route khusus untuk preview halaman error
Route::get('/error-preview/{code}', function(\$code) {
    if (view()->exists("errors.{\$code}")) {
        return view("errors.{\$code}");
    }
    abort(404);
});
PHP;
    file_put_contents($routesPath, $routesContent . $previewRoute);
}

echo "Custom error pages created.\n";
