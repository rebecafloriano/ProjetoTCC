<script src="js/jquery.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        $('#pacientes').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
        });

    });
</script>
<h1>Pacientes</h1>
<table class="table table-hover table-striped" id="pacientes">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    </tbody>

    <?php
    while ($linha = mysqli_fetch_array($consulta_pacientes)) {
        echo '<tr><td>' . $linha['name'] . '</td>';
        echo '<td>' . $linha['email'] . '</td>';
    }
    ?>
    </tbody>
</table>
