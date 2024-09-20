<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Serviço</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .header {
            background-color: #343a40;
            color: white;
            padding: 20px;
        }
    </style>
</head>
<body>
<?php 
    include_once "util/banco.php";

    if(isset($_GET['id'])){
        $id = intval($_GET['id']);

        $query = "SELECT * FROM servico WHERE id = ?";
        $prep = $banco->prepare($query);
        $prep->bind_param("i", $id);
        $prep->execute();
        $res = $prep->get_result();

        if($res->num_rows > 0){
            $servico = $res->fetch_assoc();
        }else{
            die("Serviço não encontrado");
        }
        $prep->close();
    }else{
        die("ID de serviço não fornecido");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nomeServiço = $_POST['nomeServico'];

        $update = "UPDATE servico SET nome = ? WHERE id =?";
        $updatePrep = $banco->prepare($update);
        $updatePrep->bind_param("si", $nomeServiço, $id);

        if($updatePrep->execute()){
            echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Sucesso!",
                        text: "Serviço atualizado com sucesso.",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "gerenciarServico.php";
                        }
                    });
                </script>';
        exit;
            exit;
        }else{
            echo "Erro ao atualizar o serviço ". $updatePrep->error;
        }
        $updatePrep->close();
    }
    

?>


<header class="header">
        <div class="container">
            <h1 class="text-center">Alterar Serviço</h1>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                 <a href="index.php" class="btn btn-secondary back-button">Voltar ao Menu</a>
            </li>
        </ul>
    </header>
<div class="container mt-5">
    <form method="POST">
        <div class="form-group">
            <label for="nomeServico">Nome do Serviço</label>
            <input type="text" class="form-control" name="nomeServico" value="<?php echo $servico['nome']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Serviço</button>
        <a href="gerenciarAgendamento.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
