<?php
if(!isset($_SESSION))
{
    session_start();
}

include 'conexao.php';

$name = $_POST['name'];
$price = $_POST['price'];


$sql = "SELECT * from services WHERE name ='$name'";

if ($result = mysqli_query($conn, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );


 }

    if($rowcount == 0) {
        $query = "INSERT INTO services(name, price) VALUES ('$name', $price)";
        mysqli_query($conn, $query);
        header('location:index.php?pagina=especialidades');

    } else {

            $_SESSION['msg'] = "<p style='color:red;'>Especialidade já existe;!</p>";
            header('location:index.php?pagina=inserir_especialidade');


    }
