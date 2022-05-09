<!DOCTYPE html>
<html>

<head>
    <title>Acqua - Clínica Médica</title>
    <meta charset="utf-8">

    <link rel='stylesheet' href='css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/personalizado.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <link href='css/fullcalendar.min.css' rel='stylesheet'>
    <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print'>

    <script src='js/jquery.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script src='locale/pt-br.js'></script>
</head>

<body>
    <header>
        <div class="container">
            <a href="?pagina=home"><img src="img/logo.png" title="Logo" alt="Logo"></a>
            <?php if (isset($_SESSION['login'])) { ?>
                <div id="menu">
                    <a href="?pagina=home">Início</a>
                    <a href="?pagina=pacientes">Pacientes</a>
                    <a href="?pagina=especialidades">Especialidades</a>
                    <a href="?pagina=horarios">Horários</a>
                    <a href="?pagina=novoAdmin">Admin</a>

                    <?php if (isset($_SESSION['login'])) { ?>
                        <a href="logout.php">
                            <?php echo $_SESSION['email']; ?>
                            (Sair)
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </header>

    <div id="conteudo" class="container">
