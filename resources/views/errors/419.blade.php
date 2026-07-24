<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 419 - Agregator Jurnal PKTJ</title>
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
                419
            </div>
            
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 mb-4">Sesi Kedaluwarsa</h1>
            
            <p class="text-slate-500 mb-10 max-w-md mx-auto leading-relaxed">Halaman ini telah kedaluwarsa karena Anda terlalu lama tidak beraktivitas. Silakan muat ulang (refresh) halaman.</p>
            
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