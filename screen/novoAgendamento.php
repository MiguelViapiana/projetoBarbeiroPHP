<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Agendamento</title>
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
    </style>
</head>
<body>
    <!-- Cabeçalho -->
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



    <!-- Conteúdo Principal -->
    <main class="container my-4">
        <div class="row">
           
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center">Formulário de Novo Agendamento</h2>
                <form>
                    <div class="form-group">
                        <label for="clientName">Nome do Cliente</label>
                        <input type="text" class="form-control" id="clientName" placeholder="Digite o nome do cliente">
                    </div>
                    <div class="form-group">
                        <label for="appointmentDate">Data</label>
                        <input type="date" class="form-control" id="appointmentDate">
                    </div>
                    <div class="form-group">
                        <label for="appointmentTime">Horário</label>
                        <input type="time" class="form-control" id="appointmentTime">
                    </div>
                    <div class="form-group">
                        <label for="service">Serviço</label>
                        <select class="form-control" id="service">
                            <option>Selecione o serviço</option>
                            <option>Corte de Cabelo</option>
                            <option>Barba</option>
                            <option>Corte de Cabelo e Barba</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
                    <a href="index.html" class="btn btn-secondary ml-2">Cancelar</a>
                </form>
            </div>
        </div>
    </main>

    <!-- Rodapé -->


    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
