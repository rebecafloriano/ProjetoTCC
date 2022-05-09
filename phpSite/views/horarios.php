<script src="js/jquery.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        $('#horarios').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
        });

    });
</script>
<h1>Controle de Horários</h1>

<a class="btn btn-primary" href="?pagina=inserir_horario">Inserir Horário</a>
<p><br></p>
<table class="table table-hover table-striped" id="horarios">
    <thead>
        <tr>
            <th>Especialidade</th>
            <th>Dias da semana</th>
            <th>horários</th>
            <th>Deletar</th>

        </tr>
    </thead>

    <tbody>
        <?php

        while ($linha = mysqli_fetch_array($consulta_horarios)) {


            if ($linha['weekday'] == 0) {
                $linha['weekday'] = 'Domingo';
            } elseif ($linha['weekday'] == 1) {
                $linha['weekday'] = 'Segunda-feira';
            } elseif ($linha['weekday'] == 2) {
                $linha['weekday'] = 'Terça-feira';
            } elseif ($linha['weekday'] == 3) {
                $linha['weekday'] = 'Quarta-feira';
            } elseif ($linha['weekday'] == 4) {
                $linha['weekday'] = 'Quinta-feira';
            } elseif ($linha['weekday'] == 5) {
                $linha['weekday'] = 'Sexta-feira';
            } elseif ($linha['weekday'] == 6) {
                $linha['weekday'] = 'Sábado';
            }

            echo '<tr><td>' . $linha['name'] . '</td>';
            echo '<td>' . $linha['weekday'] . '</td>';
            echo '<td>' . $linha['hours'] . '</td>';

        ?>

            <td><a class="btn btn-danger" href="deleta_horario.php?id=<?php echo $linha['id']; ?>">Deletar</a></td>
            </tr>
        <?php
        }

        ?>
    </tbody>
</table>
