<?php $this->updateLoggedInUser() ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee342539fd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Adicionar Peso</title>
</head>

<body style="background-color:rgb(51, 58, 64)">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/home">Home</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link " href="/user/profile">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/weight/create">Adicionar novo peso</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="/logout">Sair</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="card-body">
                <form action="/weight/store" method="post">
                    <div class="mb-1 mt-3">
                        <label class="form-label">Peso</label>
                        <input type="text" class="form-control" name="weight_value" required>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Data</label>
                        <input type="date" class="form-control" name="weight_date" required>
                    </div>
                    <div class="mb-1 d-flex align-items-center justify-content-center mt-2">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>