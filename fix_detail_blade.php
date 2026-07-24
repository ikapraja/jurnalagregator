<?php

function fixDetailBlade() {
    $path = 'c:/xampp/htdocs/jurnalagregator/resources/views/detail.blade.php';
    $content = file_get_contents($path);
    
    // Fix share tracking repo name
    $content = str_replace(
        "repo: '{{ \$article->source ?? 'Agregator' }}',",
        "repo: '{{ isset(\$article->repository) && is_object(\$article->repository) ? \$article->repository->name : 'Agregator' }}',",
        $content
    );
    
    // Fix bookmark tracking repo name
    $content = str_replace(
        "'{{ \$article->source ?? 'Unknown' }}'",
        "'{{ isset(\$article->repository) && is_object(\$article->repository) ? \$article->repository->name : 'Unknown' }}'",
        $content
    );
    
    file_put_contents($path, $content);
}

fixDetailBlade();
echo "detail.blade.php tracking fixed.\n";
