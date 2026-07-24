<?php
$path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$content = file_get_contents($path);

$oldScript = <<<HTML
            function showLoading() {
                Swal.fire({
                    title: 'Mencari Jurnal...',
                    html: 'Sistem sedang menelusuri <b>Crossref</b>, <b>DOAJ</b>, <b>Semantic Scholar</b>, dan berbagai sumber lainnya.<br><br>Mohon tunggu beberapa detik...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        </script>
HTML;

$newScript = <<<HTML
            function showLoading() {
                Swal.fire({
                    title: 'Mencari Jurnal...',
                    html: 'Sistem sedang menelusuri <b>Crossref</b>, <b>DOAJ</b>, <b>Semantic Scholar</b>, dan berbagai sumber lainnya.<br><br>Mohon tunggu beberapa detik...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }

            function showDownloadLoading(formatName) {
                Swal.fire({
                    title: 'Menyiapkan File ' + formatName,
                    html: 'Sistem sedang merangkum dan mengekstrak puluhan jurnal terbaik untuk Anda.<br><br>Mohon tunggu, unduhan akan otomatis dimulai sesaat lagi...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    timer: 8000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        </script>
HTML;

$content = str_replace($oldScript, $newScript, $content);
file_put_contents($path, $content);
echo "search.blade.php JS updated.\n";
?>
