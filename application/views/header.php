<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<html>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-lg-between" id="navbarNavAltMarkup">
                <div class="navbar-nav d-flex justify-content-between align-items-center">
                    <?php if (autoriza() == 'admin') : ?>
                        <a class="nav-item nav-link" href="#">
                            <?php echo anchor($uri = 'http://localhost/lojagames/', $title = 'Início', $attributes = 'class="text-decoration-none text-light"') ?>
                        </a>
                        <a class="nav-item nav-link" href="#">
                            <?php echo anchor($uri = 'http://localhost/lojagames/games/cadastro', $title = 'Cadastro', $attributes = 'class="text-decoration-none text-light"') ?>
                        </a>
                        <a class="nav-item nav-link" href="#">
                            <?php echo anchor($uri = 'http://localhost/lojagames/usuario/registro', $title = 'Cadastrar Admin', $attributes = 'class="text-decoration-none text-light"') ?>
                        </a>
                    <?php elseif(autoriza() == 'comum'): ?>
                        <a class="nav-item nav-link" href="#">
                            <?php echo anchor($uri = 'http://localhost/lojagames/', $title = 'Início', $attributes = 'class="text-decoration-none text-light"') ?>
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle text-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </button>
                            <div class="dropdown-menu">
                                <?php foreach ($categories as $category) : ?>
                                    <a class="" href="#">
                                        <?php echo anchor(
                                            $uri = 'http://localhost/lojagames/categoria/?id=' . $category['id'],
                                            $title = $category['nome'],
                                            $attributes = 'class="dropdown-item text-decoration-none"'
                                        ) ?>
                                    </a>
                                <?php endforeach ?>

                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <?php if (autoriza()) : ?>
                    <a class="nav-item nav-link align text-light text-decoration-none" href="<?php echo base_url('usuario/logout') ?>">
                        Sair</a>
                <?php endif ?>

                <?php if (!autoriza()) : ?>
                    <div>
                        <p class="text-light mb-1 text-center">Faça Login ou <a href="#" class="btn-user-register" data-bs-toggle="modal" data-bs-target="#modal-register">Cadastre-se</a></p>
                        <form action="usuario/login" method="POST">
                            <label class="text-light">
                                E-mail
                                <input type="text" name="email" id="" class="form-control">
                            </label>
                            <label class="text-light">
                                Senha
                                <input type="password" name="senha" id="" class="form-control">
                            </label>
                            <input type="submit" value="Entrar" class="btn btn-success">
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="modal-register" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Cadastro
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <form action="usuario/cadastrar" method="POST">
                        <label class="d-block my-2">
                            Nome
                            <input type="text" name="nome" class="form-control">
                        </label>
                        <label class="d-block my-2">
                            E-mail
                            <input type="text" name="email" class="form-control">
                        </label>
                        <label class="d-block my-2">
                            Senha
                            <input type="password" name="senha" class="form-control">
                        </label>
                        <input type="submit" value="Cadastrar" class="btn btn-success my-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php if ($this->session->flashdata("success")) : ?>
            <p class="alert alert-success"><?= $this->session->flashdata("success"); ?></p>
        <?php endif ?>
        <?php if ($this->session->flashdata("danger")) : ?>
            <p class="alert alert-danger"><?= $this->session->flashdata("danger"); ?></p>
        <?php endif ?>
    </div>