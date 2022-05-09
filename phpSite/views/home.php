<?php
include_once("conexao.php");
//session_start();
$result_events = "SELECT ap.id as id, u.name as nameusuario, s.name as nameservice, ap.ap_datetime FROM users u
INNER JOIN userappointments ap
ON u.id = ap.id_user
INNER JOIN services s
ON s.id = ap.id_service
order by u.name";
$resultado_events = mysqli_query($conn, $result_events);

?>


<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            defaultDate: Date(),
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            eventClick: function(event) {

                $("#excluir_agendamento").attr("href", "excluir_agendamento.php?id=" + event.id);

                $('#visualizar #id').text(event.id);
                $('#visualizar #id').val(event.id);
                $('#visualizar #title').text(event.title);
                $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
                $('#visualizar').modal('show');

                return false;
            },

            events: [
                <?php
                while ($row_events = mysqli_fetch_array($resultado_events)) {
                ?> {
                        id: '<?php echo $row_events['id']; ?>',
                        title: '<?php echo $row_events['nameservice'] . " - " . $row_events['nameusuario']; ?>',
                        start: '<?php echo $row_events['ap_datetime']; ?>',
                    },
                <?php
                }
                ?>
            ]
        });


    });
</script>

<body>
    <h1>Agenda</h1>

    <div id='calendar'></div>

    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Cancelar Agendamento</h4>


                </div>
                <div class="modal-body">
                    <dl class="dl-horizontal">

                        <dt>Id</dt>
                        <dd id="id"></dd>
                        <dt>Titulo do Evento</dt>
                        <dd id="title"></dd>
                        <dt>Inicio do Evento</dt>
                        <dd id="start"></dd>

                    </dl>
                </div>
                <div class="modal-footer">


                    <p style="background-color: red; color: white; text-align: center"><strong>ATENÇÃO: Ação irreversível!!</strong></p>
                    <a style="margin-right: 225px; background:red" href="" id="excluir_agendamento" class="btn btn-danger">Quero excluir</a>


                </div>
            </div>
        </div>
    </div>
</body>
