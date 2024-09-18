<?php

$banco = new mysqli("localhost:3306", "root", "", "bd_Barbearia");

if ($banco->connect_error) {
    die("Falha na conexão: " . $banco->connect_error);
}

function criarAgendamento(string $nomeCliente, string $data, string $hora, int $servicoId)
{
    global $banco;

    $prep = $banco->prepare("INSERT INTO agendamento(data, horario, nomeCliente, servicoId) VALUES (?, ?, ?, ?)");

    if (!$prep) {
        echo "Falha na preparação de consulta";
        die("Falha na preparação de consulta: " . $banco->error);
        
    }

    // Verificar se a data e a hora estão no formato correto
    if (DateTime::createFromFormat('Y-m-d', $data) !== false && DateTime::createFromFormat('H:i', $hora) !== false)
    {
        $prep->bind_param("sssi", $data, $hora, $nomeCliente, $servicoId);
        $prep->execute();
        
        if ($prep->error) {
            echo "Falha na execução da consulta";
            die("Falha na execução da consulta: " . $prep->error);
        }
    } else {
        echo "Formato de data ou hora inválida: " . $data ." ". $hora;
        die("Formato de data ou hora inválido!");
    }

    $prep->close();
}

function criarServico(string $nome)
{
    global $banco;

    $prep = $banco->prepare("INSERT INTO servico(nome) VALUES (?)");

    if (!$prep) {
        die("Falha na preparação da consulta: " . $banco->error);
    }

    $prep->bind_param("s", $nome);
    $prep->execute();

    if ($prep->error) {
        die("Falha na execução da consulta: " . $prep->error);
    }

    $prep->close();
}

//Criar um serviço
// criarServico("Corte de barba");
// criarServico("Corte de cabelo e barba");

// Criar um agendamento
//criarAgendamento("Miguel", "2024-09-14", "15:00:00", 2);

// function criarCliente(string $nome, String $email, int $telefone)
// {
//     global $banco;

//     $prep = $banco->prepare("INSERT INTO cliente(nome, email, telefone) VALUES (?, ?, ?)");

//     if (!$prep) {
//         die("Falha na preparação da consulta: " . $banco->error);
//     }

//     $prep->bind_param("ssi", $nome, $email, $telefone);
//     $prep->execute();

//     if ($prep->error) {
//         die("Falha na execução da consulta: " . $prep->error);
//     }

//     $prep->close();
// }

?>