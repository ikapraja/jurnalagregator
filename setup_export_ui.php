<?php
$path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$content = file_get_contents($path);

$old = <<<HTML
                <div class="mb-6 flex justify-between items-end border-b border-slate-200 pb-2">
                    <h2 class="text-xl font-extrabold text-slate-800">
                        Hasil Pencarian
                    </h2>
                    <span class="text-sm text-slate-500 font-medium">Menampilkan {{ \$articles->firstItem() ?? 0 }} hingga {{ \$articles->lastItem() ?? 0 }} dari {{ number_format(\$articles->total(), 0, ',', '.') }} hasil</span>
                </div>
HTML;

$new = <<<HTML
                <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-end border-b border-slate-200 pb-4 sm:pb-2 gap-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-xl font-extrabold text-slate-800">
                            Hasil Pencarian
                        </h2>
                        @if(isset(\$articles) && \$articles->total() > 0)
                        <div class="relative inline-block text-left" x-data="{ openDownload: false }">
                            <div>
                                <button @click="openDownload = !openDownload" @click.away="openDownload = false" type="button" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:text-[#1E3A8A] transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500/30 shadow-sm" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Download Top 100
                                    <svg class="w-3.5 h-3.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                            </div>
                            <div x-show="openDownload" style="display: none;" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 z-50 mt-2 w-56 origin-top-left sm:origin-bottom-left rounded-xl bg-white shadow-xl border border-slate-200 focus:outline-none overflow-hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="p-1" role="none">
                                    <div class="px-3 py-2 border-b border-slate-100 mb-1">
                                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Pilih Format Unduhan</p>
                                    </div>
                                    <a href="{{ route('search.export', array_merge(request()->query(), ['format' => 'csv'])) }}" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        CSV (Excel)
                                    </a>
                                    <a href="{{ route('search.export', array_merge(request()->query(), ['format' => 'bibtex'])) }}" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        BibTeX (Mendeley/Zotero)
                                    </a>
                                    <a href="{{ route('search.export', array_merge(request()->query(), ['format' => 'json'])) }}" class="text-slate-700 hover:bg-blue-50 hover:text-[#1E3A8A] group flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition-colors" role="menuitem" tabindex="-1">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                        JSON (Developer)
                                    </a>
                                </div>
                                <div class="px-3 py-2.5 bg-slate-50 border-t border-slate-100 flex gap-2 items-start">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-[10px] text-slate-500 leading-tight">Mengekspor 100 hasil teratas untuk menjaga performa sistem.</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <span class="text-sm text-slate-500 font-medium">Menampilkan {{ \$articles->firstItem() ?? 0 }} hingga {{ \$articles->lastItem() ?? 0 }} dari {{ number_format(\$articles->total(), 0, ',', '.') }} hasil</span>
                </div>
HTML;

$content = str_replace($old, $new, $content);
file_put_contents($path, $content);
echo "search.blade.php updated.\n";
?>
