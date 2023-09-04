<?php $this->updateLoggedInUser() ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee342539fd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Home</title>
</head>

<body style="background-color:rgb(51, 58, 64)">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand active" href="/home">Home</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link " href="/user/profile">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/weight/create">Adicionar novo peso</a>
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
                <h1 class="mb-3 mt-2 justify-content-center">
                    Seu peso atual é: <?php
                                        echo $_SESSION['user']->getCurrent_weight();
                                        ?> Kg
                </h1>
                <h2 class="mb-3 mt-2 justify-content-center">
                    Seu IMC é: <?php
                                echo round($_SESSION['user']->getImc(), 2);
                                ?>
                </h2>
                <h2 class="mb-4 mt-4 justify-content-center">
                    Classificação:
                </h2>
                <h3>
                    <?php
                    if ($_SESSION['user']->getImc() < 18.5)
                        echo "Seu imc indica que está abaixo do peso.";
                    else if ($_SESSION['user']->getImc() >= 18.5 && $_SESSION['user']->getImc() < 25)
                        echo "Seu imc indica que está tudo normal com seu peso.";
                    else if ($_SESSION['user']->getImc() >= 25 && $_SESSION['user']->getImc() < 30)
                        echo "Seu imc indica que está  com sobrepeso.";
                    else if ($_SESSION['user']->getImc() >= 30 && $_SESSION['user']->getImc() < 40)
                        echo "Seu imc indica que está em caso de obesidade.";
                    else
                        echo "Seu imc indica que está em caso de obesidade grave.";

                    ?>
                </h3>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 style="margin-top:18px; margin-left: 5px;">Histórico de pesos</h3>
                        <form id="form" method="get">
                            <div class="row mt-3 justify-content-end">
                                <div class="col-3 justify-content-end">
                                    <select id="list" class="form-select" name="month" form="form" required="required">
                                        <option value="" selected>Selecione uma opção</option>
                                        <option selected value="0">Todos</option>
                                        <option value="1">Janeiro</option>
                                        <option value="2">Fevereiro</option>
                                        <option value="3">Março</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Maio</option>
                                        <option value="6">Junho</option>
                                        <option value="7">Julho</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <button type="submit" form="form" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <ul id="ul" class="list-group">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const select = document.getElementById('list');
            const url = `/user/filter?month=${0}`;
            xhr = new XMLHttpRequest;
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var options = JSON.parse(xhr.responseText);
                    refreshList(options);
                }
            }
            xhr.open('get', url, true)
            xhr.send();
        });
        $("#form").submit(
            function(event) {
                const select = document.getElementById('list');
                const url = `/user/filter?month=${select.value}`;
                event.preventDefault();
                xhr = new XMLHttpRequest;
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var options = JSON.parse(xhr.responseText);
                        refreshList(options);
                    }
                }
                xhr.open('get', url, true)
                xhr.send();
            });

        function refreshList(options) {
            const ul = document.getElementById('ul');
            ul.innerHTML = '';
            for (let i = 0; i < options.length; i++) {
                const element = options[i];
                const div = document.createElement('div');
                const h = document.createElement('h5');
                const small = document.createElement('small');
                small.appendChild(document.createTextNode(element.weight_date));
                h.appendChild(document.createTextNode(element.weight_value));
                div.appendChild(h);
                div.appendChild(small);
                div.setAttribute('class', 'd-flex w-100 justify-content-between');
                const containner = document.createElement('div');
                containner.setAttribute('class', 'list-group-item list-group-item-action');
                containner.appendChild(div);
                ul.appendChild(containner);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>