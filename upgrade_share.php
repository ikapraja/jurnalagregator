<?php

function upgradeShareButton() {
    $path = 'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php';
    $content = file_get_contents($path);
    
    // We want to upgrade the Alpine component's copyLink method.
    // Let's find the x-data block:
    // x-data="{ copiedLink: false, copyLink() { navigator.clipboard.writeText(window.location.href); this.copiedLink = true; setTimeout(() => this.copiedLink = false, 2000); } }"
    
    $oldXData = 'x-data="{ copiedLink: false, copyLink() { navigator.clipboard.writeText(window.location.href); this.copiedLink = true; setTimeout(() => this.copiedLink = false, 2000); } }"';
    
    // The new logic: try navigator.share, fallback to clipboard
    $newXData = "x-data=\"{ 
        copiedLink: false, 
        copyLink() { 
            if (navigator.share) {
                navigator.share({
                    title: '{{ addslashes(Str::limit(\$article->title, 100)) }}',
                    text: 'Baca jurnal menarik ini di Agregator Jurnal PKTJ:',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(window.location.href); 
                this.copiedLink = true; 
                setTimeout(() => this.copiedLink = false, 2000); 
            }
        } 
    }\"";
    
    // In case the exact string is slightly different, let's use a regex to replace the x-data attribute
    $content = preg_replace(
        '/x-data="\{\s*copiedLink:\s*false,\s*copyLink\(\)\s*\{[^\}]+\}\s*\}"/s',
        $newXData,
        $content
    );
    
    // Fallback if regex didn't hit (due to differences in my string above)
    $content = str_replace($oldXData, $newXData, $content);
    
    file_put_contents($path, $content);
}

upgradeShareButton();
echo "Share button upgraded.\n";
