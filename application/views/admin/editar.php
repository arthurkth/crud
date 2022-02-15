
<div class="container p-4">

    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1 class=" text-center">Edição de Jogo</h1>
            <form action="<?= base_url('game/gameEdit') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="gameid" value="<?= $game->id ?>">
                    <label class=" w-100">
                        Nome
                        <input type="text" name="nome" class="form-control" value="<?= $game->nome?>">
                    </label>
                </div>
                <div class="form-group">
                    <label class=" w-100 my-2">
                        Plataforma
                        <input type="text" name="plataforma" class="form-control" value="<?= $game->plataforma ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label class=" w-100 my-2">
                        Preço
                        <input type="text" name="preco" class="form-control" value="<?= $game->preco ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label class=" w-100 my-2">
                        Em Estoque
                        <select name="estoque" class="form-control">
                            <option value="<?= $game->em_estoque ?>"">
                            <?php if ($game->em_estoque) : ?>
                                <?= 'Sim' ?>
                            </option>
                            <option value=" 0">Não</option>
                        <?php else : ?>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        <?php endif ?>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label class=" w-100 my-2">
                        Quantidade Estoque
                        <input type="text" name="qtdestoque" class="form-control" value="<?= $game->qtd_estoque ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label class=" w-100 my-2">
                        Categoria
                        <select name="categoria" class="form-control">
                            <?php foreach ($categories as $category) : ?>
                                <?php if ($category->id == $game->id_categoria) : ?>
                                    <option value="<?= $category->id?>" selected>
                                        <?php $categoriaselecionado = $category->nome ?>
                                        <?= $category->nome ?>
                                    </option>
                                    <?php continue ?>
                                <?php endif ?>
                                <option value="<?= $category->id ?>">
                                    <?= $category->nome ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label class=" w-100 my-2">
                        Imagem
                        <input type="file" name="imagem" class="form-control">
                    </label>
                </div>
                <input type="submit" value="Editar" name="submit" class="btn btn-success">
            </form>
        </div>
    </div>


</div>