<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Cadastro</title>
</head>

<body style="background-color:rgb(51, 58, 64)">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Cadastro de Cliente
                            </div>
                        </div>
                        <div id="msg" class="bg-danger"></div>
                    </div>

                    <div class="card-body">
                        <div class="mb-1 <?php if (isset($erroMsg)) echo "bg-danger ";
                                            if (isset($successMsg)) echo "bg-success" ?>" style=" border-radius: 5px;padding-left:5px;font-size:18px;">
                            <?php
                            if (isset($erroMsg)) {
                                echo $erroMsg;
                            }
                            if (isset($successMsg)) {
                                echo $successMsg;
                            }
                            ?>
                        </div>
                        <form action="/user/create" method="post">
                            <div class="mb-1">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required autocomplete="email" autofocus>
                            </div>
                            <div class="mb-1">
                                <label for="password" class="form-label">Senha</label>

                                <div class="form_control">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" minlength=6>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label for="password" class="form-label">Confirme a Senha</label>

                                <div class="form_control">
                                    <input id="confirm_password" type="password" class="form-control" name="confirm_password" required autocomplete="current-password" minlength=6>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Altura</label>
                                <input type="text" class="form-control " id="height" name="height">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Peso</label>
                                <input type="text" class="form-control " id="weight" name="weight">
                            </div>
                            <div class="mb-1 d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                            <div class=" mb-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="link-offset-2 link-underline link-underline-opacity-0" href="/">Já possui uma conta? Clique aqui para fazer login!</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>