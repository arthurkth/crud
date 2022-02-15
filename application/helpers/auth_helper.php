<?php
function authorize()
{
    $ci = get_instance();
    $usuarioLogado = $ci->session->userdata("usuario_logado");
    if ($usuarioLogado && $usuarioLogado->permissao == '1') {
        return 'admin';
    } else if ($usuarioLogado && $usuarioLogado->permissao == '0') {
        return 'comum';
    }
    return false;
}
