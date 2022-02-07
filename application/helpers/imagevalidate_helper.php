<?php
function validate($imagem, $tipo, $tamanho)
{
    define('TAMANHO_MAXIMO', (2 * 1920 * 1024));
    if (!isset($imagem)) {
        return "Por favor, selecione uma imagem";
        exit;
    }
    if (!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)) {
        return 'Isso não é uma imagem válida';
        exit;
    }
    if ($tamanho > TAMANHO_MAXIMO) {
        return 'A imagem deve possuir no máximo 2MB';
    }
}
