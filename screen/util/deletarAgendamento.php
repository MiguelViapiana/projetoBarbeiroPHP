<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php 
    include_once "banco.php";

    if(isset($_GET['id'])){
        $id = intval($_GET['id']);
        
        $query = "DELETE FROM agendamento WHERE id = ?";
        $prep = $banco->prepare($query);

        if($prep){
            $prep->bind_param("i", $id);
            if($prep->execute()){
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Sucesso!",
                        text: "Agendamento deletado com sucesso!",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../gerenciarAgendamento.php";
                        }
                    });
                </script>';
                exit;
            } else {
                echo "Erro ao deletar o agendamento: " . $prep->error;
            }
            $prep->close();
        }
    } else {
        echo "ID de agendamento não fornecido.";
    }
    $banco->close();

?>

</body>
</html>