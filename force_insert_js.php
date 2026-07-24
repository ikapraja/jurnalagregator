<?php
$path = 'c:/xampp/htdocs/jurnalagregator/resources/views/search.blade.php';
$content = file_get_contents($path);

$scriptToInsert = <<<HTML

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

$content = str_replace('</script>', $scriptToInsert, $content);
file_put_contents($path, $content);
echo "search.blade.php script appended.\n";
?>
