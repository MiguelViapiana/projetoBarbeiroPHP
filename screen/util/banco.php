<?php

$banco = new mysqli("localhost:3306", "root", "", "bd_Barbearia");

// Verificar a conexão
if ($banco->connect_error) {
    die("Falha na conexão: " . $banco->connect_error);
}

function criarAgendamento(string $nomeCliente, string $data, string $hora, int $servicoId)
{
    global $banco;

    // Preparar a consulta SQL
    $prep = $banco->prepare("INSERT INTO agendamento(data, horario, nomeCliente, servicoId) VALUES (?, ?, ?, ?)");

    if (!$prep) {
        die("Falha na preparação de consulta: " . $banco->error);
    }

    // Verificar se a data e a hora estão no formato correto
    if (DateTime::createFromFormat('Y-m-d', $data) !== false && DateTime::createFromFormat('H:i:s', $hora) !== false)
    {
        $prep->bind_param("sssi", $data, $hora, $nomeCliente, $servicoId);
        $prep->execute();
        
        if ($prep->error) {
            die("Falha na execução da consulta: " . $prep->error);
        }
    } else {
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

// Exemplo de uso

// Criar um agendamento
criarAgendamento("Miguel", "2024-09-14", "15:00:00", 2);

$banco->close();

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