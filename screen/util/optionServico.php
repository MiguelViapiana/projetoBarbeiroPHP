<?php 

    include_once "banco.php";

    $res = $banco->query("SELECT id, nome FROM servico");

    if($res -> num_rows > 0){
        while($row = $res->fetch_assoc()){
            echo '<option value ="' .$row['id'] . '">' . $row['nome'] . '</option>';
        }
    }
    else {
        echo '<option value="">Nenhum serviço disponível</option>';
    }
    
?>