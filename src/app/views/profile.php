<?php $this->updateLoggedInUser() ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ee342539fd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Perfil</title>
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
                                    <a class="nav-link active" href="/user/profile">Perfil</a>
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
                <div class="mb-1 <?php if (isset($successMsg)) echo "bg-success" ?>" style=" border-radius: 5px;padding-left:5px;font-size:18px;">
                    <?php
                    if (isset($successMsg)) {
                        echo $successMsg;
                    }
                    ?>
                </div>
                <div class="mb-1 <?php if (isset($erroMsg)) echo "bg-danger" ?>" style=" border-radius: 5px;padding-left:5px;font-size:18px;">
                    <?php
                    if (isset($erroMsg)) {
                        echo $erroMsg;
                    }
                    ?>
                </div>
                <form action="/user/update" method="post">
                    <div class="mb-1 mt-3">
                        <label class="form-label">Nome</label>
                        <input id="name" name="name" class="form-control" value="<?php echo $_SESSION['user']->getName() ?>" required disabled="true">
                    </div>
                    <div class="mb-1 mt-3">
                        <label class="form-label">Email</label>
                        <input id="email" name="email" class="form-control" value="<?php echo $_SESSION['user']->getEmail() ?>" required disabled="true">
                    </div>
                    <div class="mb-1 mt-3">
                        <div class="card">
                            <div class="card-header">
                                Senha
                            </div>
                            <div class="card-body">
                                <div id="password_field" class="card-body" style="display: none;">
                                    <label class="form-label">Nova Senha</label>
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                                    <label class="form-label"> Confirme a Senha</label>
                                    <input id="confirm_password" type="password" class="form-control" name="confirm_password" autocomplete="current-password">
                                </div>
                                <button id="password_button" type="button" class="btn btn-primary">Alterar senha</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1 mt-3">
                        <label class="form-label">Altura</label>
                        <input id="height" name="height" class="form-control" value="<?php echo $_SESSION['user']->getHeight() ?>" required disabled="true">
                    </div>
                    <div class="mb-1 d-flex align-items-center justify-content-center mt-2">
                        <button id="edit_button" type="submit" class="btn btn-primary">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#password_button").click(function(e) {
                e.preventDefault();
                const camp = document.getElementById('password_field');
                camp.style.display === 'none' ? camp.style.display = 'block' : camp.style.display = 'none';
                $("#password_button").attr("style", "display:none");
                $("#password").attr("required", "true");
                $("#confirm_password").attr("required", "true");
                habilitaEdit();
            });
        });

        function habilitaEdit() {
            $('#name').removeAttr('disabled');
            $('#email').removeAttr('disabled');
            $('#height').removeAttr('disabled');
            const btn = document.getElementById('edit_button');
            if (btn) {
                btn.innerHTML = "Salvar";
                $('#edit_button').attr('id', 'save_button');
            }
        }

        $(function() {
            $('#edit_button').one('click', function(e) {
                e.preventDefault();
                habilitaEdit();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>