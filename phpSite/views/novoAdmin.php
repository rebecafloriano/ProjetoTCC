<?php
if (!isset($_SESSION)) {
    session_start();
}

?>

<script src="js/jquery.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        $('#admin').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
        });

    });
</script>
<h1>Admin</h1>
<a class="btn btn-primary" href="?pagina=inserir_admin">Cadastrar Admin</a>
<p><br></p>


<table class="table table-hover table-striped" id="admin">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($linha = mysqli_fetch_array($consulta_admin)) {
            echo '<tr><td>' . $linha['name'] . '</td>';
            echo '<td>' . $linha['email'] . '</td>';
        }
        ?>
    </tbody>
</table>
