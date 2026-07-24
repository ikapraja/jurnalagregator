<?php

function fixSearchFilters() {
    $path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
    $content = file_get_contents($path);
    
    // 1. Remove text-center and style="text-align-last: center;" from inputs and selects
    // For inputs:
    $content = str_replace(
        'class="w-full text-center bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-4 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm"',
        'class="w-full text-left bg-[#F8FAFC] border border-slate-200 text-slate-800 py-3 px-3 rounded-xl focus:ring-2 focus:ring-[#1E3A8A]/20 focus:border-[#1E3A8A] transition text-sm"',
        $content
    );
    // For selects:
    $content = str_replace(
        'style="text-align-last: center;" class="w-full text-center',
        'class="w-full text-left',
        $content
    );
    // There are some left-over selects because I replaced the whole class string above for inputs, let's just make sure all of them are replaced.
    $content = str_replace(
        'style="text-align-last: center;"',
        '',
        $content
    );
    $content = str_replace(
        'text-center bg-[#F8FAFC]',
        'text-left bg-[#F8FAFC]',
        $content
    );

    // 2. Add missing sources
    $oldSources = <<<HTML
                                    <option value="all" {{ request('source') == 'all' ? 'selected' : '' }}>Semua Database</option>
                                    <option value="crossref" {{ request('source') == 'crossref' ? 'selected' : '' }}>Crossref</option>
                                    <option value="doaj" {{ request('source') == 'doaj' ? 'selected' : '' }}>DOAJ</option>
                                    <option value="semantic_scholar" {{ request('source') == 'semantic_scholar' ? 'selected' : '' }}>Semantic Scholar</option>
                                    <option value="openalex" {{ request('source') == 'openalex' ? 'selected' : '' }}>OpenAlex</option>
HTML;

    $newSources = <<<HTML
                                    <option value="all" {{ request('source') == 'all' ? 'selected' : '' }}>Semua Database</option>
                                    <option value="crossref" {{ request('source') == 'crossref' ? 'selected' : '' }}>Crossref</option>
                                    <option value="doaj" {{ request('source') == 'doaj' ? 'selected' : '' }}>DOAJ</option>
                                    <option value="semantic_scholar" {{ request('source') == 'semantic_scholar' ? 'selected' : '' }}>Semantic Scholar</option>
                                    <option value="openalex" {{ request('source') == 'openalex' ? 'selected' : '' }}>OpenAlex</option>
                                    <option value="ieee" {{ request('source') == 'ieee' ? 'selected' : '' }}>IEEE Xplore</option>
                                    <option value="core" {{ request('source') == 'core' ? 'selected' : '' }}>CORE</option>
                                    <option value="europepmc" {{ request('source') == 'europepmc' ? 'selected' : '' }}>Europe PMC</option>
HTML;

    $content = str_replace($oldSources, $newSources, $content);
    
    file_put_contents($path, $content);
}

fixSearchFilters();
echo "Search filters fixed.\n";
