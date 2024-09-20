<?php
    include_once "util/banco.php";

    $query = "
        SELECT a.id, a.nomeCliente, a.data, a.horario, s.nome AS servico
        FROM agendamento a
        JOIN servico s ON a.servicoId = s.id
        ORDER BY a.data, a.horario
    ";

    $res = $banco->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Agendamentos</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #343a40;
            color: white;
            padding: 20px;
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <h1 class="text-center">Lista de Agendamentos</h1>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                 <a href="index.php" class="btn btn-secondary back-button">Voltar ao Menu</a>
            </li>
        </ul>
    </header>

    <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Cliente</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Serviço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($res->num_rows > 0){

                        while($row = $res->fetch_assoc()){
                            echo '<tr>';
                                echo '<td>'.htmlspecialchars($row['id']).'</td>';
                                echo '<td>'.htmlspecialchars($row['nomeCliente']).'</td>';
                                echo '<td>'.date('d/m/Y', strtotime($row['data'])).'</td>';
                                echo '<td>'.date('H:i', strtotime($row['horario'])).'</td>';
                                echo '<td>'.htmlspecialchars($row['servico']).'</td>';
                ?>
                                <td>
                                    <a href="alterarAgendamento.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Alterar</a>
                                    <a href="util/deletarAgendamento.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este agendamento?');">Deletar</a>
                                </td>
                <?php
                            echo '</tr>';
                        }
                    }else{
                    echo '<div class="alert alert-info" role="alert">';
                        echo 'Nenhum agendamento encontrado.';
                    echo '</div>';
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>