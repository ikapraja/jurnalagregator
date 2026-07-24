<?php
$path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$content = file_get_contents($path);

// 1. Ubah href menjadi fetch trigger di Dropdown
$dropdownOld = <<<HTML
                                    <a href="{{ route('search.export', array_merge(request()->query(), ['format' => 'csv'])) }}" onclick="showDownloadLoading('CSV')" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        CSV (Excel)
                                    </a>
                                    <a href="{{ route('search.export', array_merge(request()->query(), ['format' => 'bibtex'])) }}" onclick="showDownloadLoading('BibTeX')" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        BibTeX (Mendeley/Zotero)
                                    </a>
                                    <a href="{{ route('search.export', array_merge(request()->query(), ['format' => 'json'])) }}" onclick="showDownloadLoading('JSON')" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                        JSON (Developer)
                                    </a>
HTML;

$dropdownNew = <<<HTML
                                    <a href="#" @click.prevent="startDownload('CSV', '{{ route('search.export', array_merge(request()->query(), ['format' => 'csv'])) }}'); openDownload = false" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        CSV (Excel)
                                    </a>
                                    <a href="#" @click.prevent="startDownload('BibTeX', '{{ route('search.export', array_merge(request()->query(), ['format' => 'bibtex'])) }}'); openDownload = false" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        BibTeX (Mendeley/Zotero)
                                    </a>
                                    <a href="#" @click.prevent="startDownload('JSON', '{{ route('search.export', array_merge(request()->query(), ['format' => 'json'])) }}'); openDownload = false" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                        JSON (Developer)
                                    </a>
HTML;
$content = str_replace($dropdownOld, $dropdownNew, $content);

// 2. Ubah struktur overlay UI
$overlayOld = <<<HTML
            <h3 class="text-xl font-extrabold text-slate-800 mb-2 text-center">Menyisir Database...</h3>
            <p class="text-sm text-slate-500 text-center font-medium leading-relaxed">
                Menarik jutaan data jurnal secara real-time dari seluruh dunia. Mohon tunggu sebentar.
            </p>
HTML;

$overlayNew = <<<HTML
            <h3 class="text-xl font-extrabold text-slate-800 mb-2 text-center" x-text="loadingTitle">Menyisir Database...</h3>
            <p class="text-sm text-slate-500 text-center font-medium leading-relaxed" x-text="loadingText">
                Menarik jutaan data jurnal secara real-time dari seluruh dunia. Mohon tunggu sebentar.
            </p>
HTML;
$content = str_replace($overlayOld, $overlayNew, $content);


// 3. Update AlpineJS state
$alpineOld = <<<HTML
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchOverlay', () => ({
                isSearching: false,
                progress: 0,
                startSearch() {
                    this.isSearching = true;
                    this.progress = 0;
                    
                    let interval = setInterval(() => {
                        if (this.progress < 85) {
                            this.progress += Math.floor(Math.random() * 15) + 5;
                            if (this.progress > 85) this.progress = 85;
                        } else if (this.progress < 98) {
                            this.progress += 1;
                        }
                    }, 400);
                }
            }))
        })
HTML;

$alpineNew = <<<HTML
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchOverlay', () => ({
                isSearching: false,
                progress: 0,
                loadingTitle: 'Menyisir Database...',
                loadingText: 'Menarik jutaan data jurnal secara real-time dari seluruh dunia. Mohon tunggu sebentar.',
                startSearch() {
                    this.loadingTitle = 'Menyisir Database...';
                    this.loadingText = 'Menarik jutaan data jurnal secara real-time dari seluruh dunia. Mohon tunggu sebentar.';
                    this.isSearching = true;
                    this.progress = 0;
                    
                    let interval = setInterval(() => {
                        if (this.progress < 85) {
                            this.progress += Math.floor(Math.random() * 15) + 5;
                            if (this.progress > 85) this.progress = 85;
                        } else if (this.progress < 98) {
                            this.progress += 1;
                        }
                    }, 400);
                },
                startDownload(format, url) {
                    this.loadingTitle = 'Menyiapkan File ' + format + '...';
                    this.loadingText = 'Sistem sedang merangkum dan mengekstrak puluhan jurnal terbaik untuk Anda. Mohon tunggu...';
                    this.isSearching = true;
                    this.progress = 0;
                    
                    let interval = setInterval(() => {
                        if (this.progress < 85) {
                            this.progress += Math.floor(Math.random() * 15) + 5;
                            if (this.progress > 85) this.progress = 85;
                        } else if (this.progress < 98) {
                            this.progress += 1;
                        }
                    }, 400);

                    fetch(url)
                        .then(response => {
                            let filename = 'Export_Jurnal_' + format + '.txt';
                            let disposition = response.headers.get('content-disposition');
                            if (disposition && disposition.indexOf('attachment') !== -1) {
                                let filenameRegex = /filename[^;=\\n]*=((['"]).*?\\2|[^;\\n]*)/;
                                let matches = filenameRegex.exec(disposition);
                                if (matches != null && matches[1]) { 
                                    filename = matches[1].replace(/['"]/g, '');
                                }
                            }
                            return response.blob().then(blob => ({ blob, filename }));
                        })
                        .then(({ blob, filename }) => {
                            this.progress = 100;
                            setTimeout(() => {
                                clearInterval(interval);
                                this.isSearching = false;
                                
                                const objectUrl = window.URL.createObjectURL(blob);
                                const a = document.createElement('a');
                                a.style.display = 'none';
                                a.href = objectUrl;
                                a.download = filename;
                                document.body.appendChild(a);
                                a.click();
                                window.URL.revokeObjectURL(objectUrl);
                            }, 500);
                        })
                        .catch(() => {
                            clearInterval(interval);
                            this.isSearching = false;
                            Swal.fire({icon:'error', title:'Oops...', text:'Gagal mengunduh file!'});
                        });
                }
            }))
        })
HTML;
$content = str_replace($alpineOld, $alpineNew, $content);

// 4. Hapus script showDownloadLoading sebelumnya
$content = preg_replace('/function showDownloadLoading\(formatName\) \{.*?\}/s', '', $content);

file_put_contents($path, $content);
echo "search.blade.php updated with fetch download.\n";
?>
