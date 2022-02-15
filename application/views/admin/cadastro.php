
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1 class="text-center">Cadastro de Jogo</h1>
            <form action="gameRegister" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="w-100">
                        Nome
                        <input type="text" name="nome" class="form-control">
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100 my-2">
                        Plataforma
                        <input type="text" name="plataforma" class="form-control">
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100 my-2">
                        Preço
                        <input type="text" name="preco" class="form-control">
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100 my-2">
                        Em Estoque
                        <select name="estoque" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100 my-2">
                        Quantidade Estoque
                        <input type="text" name="qtdestoque" class="form-control">
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100 my-2">
                        Categoria
                        <select name="categoria" class="form-control">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->id ?>">
                                    <?= $category->nome ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label class="w-100 my-2">
                        Imagem
                        <input type="file" name="imagem" class="form-control">
                    </label>
                </div>
                <input type="submit" value="Cadastrar" name="submit" class="btn btn-success">
            </form>
        </div>
    </div>


</div>