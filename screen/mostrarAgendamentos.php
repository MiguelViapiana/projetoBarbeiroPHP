<?php

require_once "util/banco.php";

$query = "SELECT a.id, a.nomeCliente, a.data, a.horario, s.nome AS servico
          FROM agendamento a
          JOIN servico s ON a.servicoId = s.id
          ORDER BY a.data, a.horario";
$resultado = $banco->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos da Barbearia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="text-center">Agendamentos da Barbearia</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Cliente</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Serviço</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nomeCliente']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['data'])); ?></td>
                        <td><?php echo date('H:i', strtotime($row['horario'])); ?></td>
                        <td><?php echo $row['servico']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Nenhum agendamento encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Fecha a conexão
$banco->close();
?>
