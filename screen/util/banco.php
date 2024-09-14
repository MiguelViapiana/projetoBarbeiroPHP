<?php 

$banco = new mysqli("localhost:3306", "root", "", "bd_Barbearia");

function criarCliente(string $nome, String $email, int $telefone){
    global $banco;

    $prep = $banco->prepare( "INSERT INTO cliente(nome, email, telefone) VALUES (?, ?, ?)");

    if(!$prep){
        die("Falha na preparação consulta: ". $banco->error);
    }

    $prep->bind_param("ssi", $nome, $email, $telefone);
    $prep->execute();

    if($prep->error){
        die("Falha na execução da consulta: ".$prep->error);
    }

    $prep->close();

}

//criarCliente("Miguel", "migvjung@gmail.com", 41997786784);

?>