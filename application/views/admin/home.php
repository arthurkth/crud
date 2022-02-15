
<body>
    <div class="container p-4">
        <div class="row justify-content-center">
            <h1 class="text-center">Produtos Cadastrados</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($games as $game) : ?>
                        <tr>
                            <td><?= $game->id ?></td>
                            <td><?= $game->nome ?></td>
                            <td class="d-flex justify-content-center">
                                <a href="<?= base_url('game/edit/' . $game->id) ?>" class="btn btn-danger m-1">Editar</a>
                                <button class="btn btn-warning d-block m-1" data-bs-toggle="modal" data-bs-target="#modal-delete">Excluir</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-delete" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Tem certeza que deseja excluir o item?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <a href="<?= base_url('game/delete/' . $game->id) ?>" class="btn btn-success">
                        Sim
                    </a>
                    <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="close">
                        Não
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

