<?php
if(!isset($_SESSION))
{
    session_start();
}

include("conexao.php");

$name = mysqli_real_escape_string($conn, trim($_POST['name']));
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$password = mysqli_real_escape_string($conn, trim(password_hash($_POST['password'], PASSWORD_DEFAULT)));

$sql = "SELECT COUNT(*) AS total FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
    $_SESSION['msg'] = "<p style='color:red;'>Usuário já é cadastrado!</p>";
   header('location:index.php?pagina=inserir_admin');
    exit;
}

$sql = "INSERT INTO users (name, email, password, admin) VALUES ('$name', '$email', '$password',1 )";

if($conn->query($sql) === TRUE) {
    header('location:index.php?pagina=novoAdmin');

}

$conn->close();

header('location:index.php?pagina=novoAdmin');
exit;
