<?php
include_once 'conexao.php';



$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    $query_event = "DELETE FROM userappointments WHERE id=$id";
    $delete_event = $conn->prepare($query_event);

    $delete_event->execute();

    header("Location:index.php");
} else {
    header("Location:index.php");
}
