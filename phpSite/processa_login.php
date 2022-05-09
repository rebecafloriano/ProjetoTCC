<?php

include 'conexao.php';

$email = addslashes($_POST['email']);
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email' AND admin = 1";

$consulta = mysqli_query($conn, $query);

if (mysqli_num_rows($consulta) == 1) {
    while ($row = mysqli_fetch_assoc($consulta)) {
        if (password_verify($password, $row['password'])) {
            session_start();

            $_SESSION['login'] = true;
            $_SESSION['email'] = $email;
            header('location:index.php');
        
        } else {
            header('location:index.php?erro');
        }
    }
} else {
    header('location:index.php?erro');
}
