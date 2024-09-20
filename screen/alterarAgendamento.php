<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Agendamento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
<?php

    include_once "util/banco.php";

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); 

        
        $query = "SELECT * FROM agendamento WHERE id = ?";
        $prep = $banco->prepare($query);
        $prep->bind_param("i", $id);
        $prep->execute();
        $resultado = $prep->get_result();
        

        if ($resultado->num_rows > 0) {
            $agendamento = $resultado->fetch_assoc();
        } else {
            die("Agendamento não encontrado.");
        }
        $prep->close();
    } else {
        die("ID de agendamento não fornecido.");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomeCliente = $_POST['nomeCliente'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $servicoId = $_POST['servicoId'];

        $updateQuery = "UPDATE agendamento SET nomeCliente = ?, data = ?, horario = ?, servicoId = ? WHERE id = ?";
        $updatePrep = $banco->prepare($updateQuery);
        $updatePrep->bind_param("sssii", $nomeCliente, $data, $hora, $servicoId, $id);

        if ($updatePrep->execute()) {
            echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Sucesso!",
                        text: "Agendamento atualizado com sucesso.",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "gerenciarServico.php";
                        }
                    });
                </script>';
            exit;
        } else {
            echo "Erro ao atualizar o agendamento: " . $updatePrep->error;
        }
        $updatePrep->close();
    }

?>


<div class="container mt-5">
    <form method="POST">
        <div class="form-group">
            <label for="nomeCliente">Nome do Cliente</label>
            <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" value="<?php echo $agendamento['nomeCliente']; ?>" required>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" value="<?php echo date('Y-m-d', strtotime($agendamento['data'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="hora">Horário</label>
            <input type="time" class="form-control" id="hora" name="hora" value="<?php echo date('H:i', strtotime($agendamento['horario'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="servicoId">Serviço</label>
            <select class="form-control" id="servicoId" name="servicoId" required>
                <option value="">Selecione um serviço</option>
                <?php
                    include_once "banco.php";
                    $res = $banco->query("SELECT id, nome FROM servico");
                
                    if ($res->num_rows > 0) {
                        
                        $servicoSelecionado = isset($agendamento['servicoId']) ? $agendamento['servicoId'] : '';
                
                        while ($row = $res->fetch_assoc()) {
                            $selected = ($row['id'] == $servicoSelecionado) ? 'selected' : '';
                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nome'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum serviço disponível</option>';
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Agendamento</button>
        <a href="gerenciarAgendamento.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
