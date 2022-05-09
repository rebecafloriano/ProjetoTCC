<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'conexao.php';

$id_service = $_POST['id_service'];
$weekday = $_POST['weekday'];
$hours = $_POST['hours'];

if ($hours == 0) {
    $_SESSION['msg'] = "<p style='color:red;'>É necessário adicionar ao menos um horário!</p>";
    header('location:index.php?pagina=inserir_horario');
}
//var_dump($hours);

// ordenando array
sort($hours);

$string = implode(",", $hours);
$hours = $string;


//var_dump($hours);

$sql = "SELECT * from serviceavailability WHERE id_service =$id_service AND weekday =$weekday";

if ($result = mysqli_query($conn, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows($result);
    echo $rowcount;
}

if ($rowcount == 0) {
    $query = "INSERT INTO serviceavailability(id_service, weekday, hours) VALUES ('$id_service', $weekday, '$hours')";
    mysqli_query($conn, $query);
    header('location:index.php?pagina=horarios');
} else {

    $_SESSION['msg'] = "<p style='color:red;'>Dia da semana já existe para essa especialidade!</p>";
    header('location:index.php?pagina=inserir_horario');
}
