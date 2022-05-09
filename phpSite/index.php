<?php
session_start();

include_once("conexao.php");

include_once("header.php");

# Conteúdo da página dinâmico
if (isset($_SESSION['login'])) {
    if (isset($_GET['pagina'])) {
        $pagina = $_GET['pagina'];
    } else {
        $pagina = 'home';
    }
} else {
    $pagina = 'login';
}

switch ($pagina) {
    case 'login':
        include 'views/login.php';
        break;
    case 'inserir_admin':
        include 'views/inserir_admin.php';
        break;
    case 'especialidades':
        include 'views/especialidades.php';
        break;
    case 'pacientes':
        include 'views/pacientes.php';
        break;
    case 'horarios':
        include 'views/horarios.php';
        break;
    case 'novoAdmin':
        include 'views/novoAdmin.php';
        break;
    case 'inserir_especialidade':
        include 'views/inserir_especialidade.php';
        break;
    case 'inserir_horario':
        include 'views/inserir_horario.php';
        break;

    default:
        include 'views/home.php';
        break;
}




include_once("footer.php");
