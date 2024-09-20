<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Barbearia</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #343a40;
            color: white;
            padding: 20px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .button-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <header class="header">
        <div class="container">
            <h1 class="text-center">Agenda de Barbearia</h1>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container my-4">
        <div class="button-group text-center">
            <a href="mostrarAgendamentos.php" class="btn btn-primary mx-2">Visualizar Próximos Agendamentos</a>
            <a href="novoAgendamento.php" class="btn btn-secondary mx-2">Novo Agendamento</a>
            <a href="novoServico.php" class="btn btn-secondary mx-2">Novo Serviço</a>
            <a href="gerenciarAgendamento.php" class="btn btn-success mx-2">Gerenciar Agendamentos</a>
            <a href="gerenciarServico.php" class="btn btn-success mx-2">Gerenciar Serviços</a>
        </div>
        <?php 
        
        include_once "util/banco.php";

        $dataAtual = date("Y-m-d");
        $horaAtual = date("H:i:s");
        $query = "SELECT a.id, a.nomeCliente, a.data, a.horario, s.nome AS servico
                FROM agendamento a
                JOIN servico s ON a.servicoId = s.id
                WHERE a.data > ? OR (a.data >= ? AND a.horario >= ?)
                ORDER BY  a.data, a.horario LIMIT 2";

        $prep = $banco->prepare($query);
        $prep->bind_param("sss", $dataAtual, $dataAtual, $horaAtual);
        $prep->execute();
        $res = $prep->get_result();
        
        ?>

        <div class="row">
            <div class="col-md-12">
                <h2>Próximos Agendamentos</h2>
                <?php 
                    if($res->num_rows > 0){

                        while($row = $res->fetch_assoc()){
                            echo '<div class="appointment-card card mb-3">';
                                echo ' <div class="card-body">';
                                    echo '<h5 class="card-title">'. htmlspecialchars($row['nomeCliente']). '</h5>';
                                    echo '<p class="card-text">Data: '. date('d/m/Y', strtotime($row['data'])). '</p>';
                                    echo ' <p class="card-text">Horário: '. date('H:i', strtotime($row['horario'])). '</p>';
                                    echo '<p class="card-text">Serviço: '. htmlspecialchars($row['servico']). '</p>';
                                echo '</div>';
                            echo '</div>';
                        }


                    }else{
                        echo '<div class="alert alert-info" role="alert">';
                            echo 'Nenhum agendamento encontrado.';
                        echo '</div>';
                    }
                
                ?>
                <!-- <div class="appointment-card card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">João Silva</h5>
                        <p class="card-text">Data: 15/09/2024</p>
                        <p class="card-text">Horário: 10:00</p>
                        <p class="card-text">Serviço: Corte de Cabelo</p>
                        <a href="#" class="btn btn-primary">Detalhes</a>
                -->

    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
    require_once "util/banco.php";

?>

