<head>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/home.css") ?>">
</head>

<div class="container p-4">
    <h1 class="text-light text-center">Jogos Disponíveis</h1>
    <div class="row container-games justify-content-center justify-content-lg-evenly justify-content-xl-between">
        <?php foreach ($games as $game) : ?>
            <div class="col-12 col-md-10 col-lg-4 col-xl-2 m-1 p-0 my-4 d-flex flex-column justify-content-between game-box">
                <?php echo '<img src="data:image/png;base64,' . base64_encode($game->imagem) . '" class="banner-game"/>'; ?>
                <p class="text-banner-title my-2 px-1"><strong><?= $game->nome ?></strong></p>
                <p class="text-banner text-banner-plataform m-0 px-1"><?= $game->plataforma ?></p>
                <div class="row">
                    <div class="col-6 pl-0 pr-3">
                        <p class="text-banner-category px-1"><?= $game->nome_categoria ?></p>
                    </div>
                    <div class="col-6 px-3 text-end">
                        <p class="text-banner-price px-1">R$ <?= $game->preco ?></p>
                    </div>
                    <a class="btn-buy" href="">Comprar</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>

</div>