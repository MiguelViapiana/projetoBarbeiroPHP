<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php 
    include_once "banco.php";

 
    if(isset($_GET['id'])){
        $id = intval($_GET['id']);
       
        $checkQuery = "SELECT COUNT(*) as total FROM agendamento WHERE servicoId = ?";
        $checkPrep = $banco->prepare($checkQuery);
        
        if($checkPrep){
            $checkPrep->bind_param("i", $id);
            $checkPrep->execute();
            $checkResult = $checkPrep->get_result();
            $row =$checkResult->fetch_assoc();

            if($row['total'] > 0){
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: "info",
                        title: "Aviso",
                        text: "Não é possível excluir o serviço, pois ele está associado a um ou mais agendamentos.",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../gerenciarServico.php";
                        }
                    });
                </script>';

            }else{
                $query = "DELETE FROM servico WHERE id = ?";
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
                            text: "Serviço deletado com sucesso!",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../gerenciarServico.php";
                            }
                        });
                    </script>';
                        exit;
                    } else {
                        echo "Erro ao deletar o serviço: " . $prep->error;
                    }
                    $prep->close();
                }
            }
        }
        $checkPrep->close();
        
    } else {
        echo "ID de serviço não fornecido.";
    }
    $banco->close();

?>
</body>
</html>
