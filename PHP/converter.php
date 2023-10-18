<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];
    
    // Execute o youtube-dl para baixar o vídeo do YouTube e converter para MP3
    exec("youtube-dl --extract-audio --audio-format mp3 $url", $output, $returnCode);

    if ($returnCode === 0) {
        // Se a conversão for bem-sucedida, forneça um link para o download
        $mp3File = "output.mp3";
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"$mp3File\"");
        readfile($mp3File);
        unlink($mp3File);
        exit;
    } else {
        echo "Erro na conversão.";
    }
}
?>
