<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Barbearia</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        .button-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <header class="header">
        <div class="container">
            <h1 class="text-center">Agenda de Barbearia</h1>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container my-4">
        <div class="button-group text-center">
            <a href="#" class="btn btn-primary mx-2">Visualizar Próximos Agendamentos</a>
            <a href="novoAgendamento.php" class="btn btn-secondary mx-2">Novo Agendamento</a>
            <a href="#" class="btn btn-success mx-2">Gerenciar Agendamentos</a>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <h2>Próximos Agendamentos</h2>
                <div class="appointment-card card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">João Silva</h5>
                        <p class="card-text">Data: 15/09/2024</p>
                        <p class="card-text">Horário: 10:00</p>
                        <p class="card-text">Serviço: Corte de Cabelo</p>
                        <a href="#" class="btn btn-primary">Detalhes</a>
                    </div>
                </div>
                <div class="appointment-card card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Maria Oliveira</h5>
                        <p class="card-text">Data: 16/09/2024</p>
                        <p class="card-text">Horário: 14:00</p>
                        <p class="card-text">Serviço: Barba e Corte</p>
                        <a href="#" class="btn btn-primary">Detalhes</a>
                    </div>
                </div>
                <!-- Adicione mais cartões de agendamento aqui -->
            </div>
        </div>
    </main>

    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

