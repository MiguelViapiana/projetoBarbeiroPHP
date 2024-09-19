<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Agendamento</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
    </style>
</head>
<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>

        function showAlert(message) {
            Swal.fire({
                icon: 'info',
                title: 'Aviso',
                text: message,
                confirmButtonText: 'OK'
            });
        }

        function successAlert(){
            Swal.fire({
            title: "Sucesso!!",
            text: "Agendamento realizado!",
            icon: "success"
            });
        }

    </script>

    <header class="header">
        <div class="container">
            <h1 class="text-center">Adicionar Novo Agendamento</h1>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                 <a href="index.php" class="btn btn-secondary back-button">Voltar ao Menu</a>
            </li>
        </ul>
    </header>

    <main class="container my-4">
        <div class="row">
           
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center">Formulário de Novo Agendamento</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="clientName">Nome do Cliente</label>
                        <input type="text" class="form-control" id="clientName" placeholder="Digite o nome do cliente" name="nomeCliente" required>
                    </div>
                    <div class="form-group">
                        <label for="appointmentDate">Data</label>
                        <input type="date" class="form-control" id="appointmentDate" name="data" required>
                    </div>
                    <div class="form-group">
                        <label for="appointmentTime">Horário</label>
                        <input type="time" class="form-control" id="appointmentTime" name="hora" required >
                    </div>
                    <div class="form-group">
                        <label for="service">Serviço</label>
                        <select class="form-control" id="service" name="servico" required>
                            <option value="">Selecione um serviço</option>
                            <<?php 
                                require_once "util/optionServico.php";
                            ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Salvar Agendamento" name="salvar">
                    <input type="reset" class="btn btn-secondary" value="Limpar">
                </form>
            </div>
        </div>
    </main>

    <<?php 
    
    require_once "util/banco.php";
    session_start();

    if(isset($_POST['salvar'])){
        $nomeCliente = $_POST['nomeCliente'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $servico = $_POST['servico'];

        try{

            $verif = $banco->prepare("SELECT * FROM agendamento WHERE nomeCliente = ? AND data = ? AND horario = ?");
            $verif ->  bind_param("sss", $nomeCliente, $data, $hora);
            $verif -> execute();
            $resp = $verif -> get_result();


            if($resp->num_rows == 0){
                criarAgendamento($nomeCliente, $data, $hora, $servico);
                echo "<script type='text/javascript'>
                    successAlert();
                  </script>";    
            }else{
                echo "<script type='text/javascript'>
                    showAlert('O agendamento já existe para o cliente, data e horário informados.');
                  </script>";                
            }

            $verif -> close();
        }
        catch (mysqli_sql_exception $e) {
            echo "Erro de SQL: " . $e->getMessage();
        }

    }
    

?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
