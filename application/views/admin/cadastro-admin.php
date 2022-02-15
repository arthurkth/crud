<body>
    <div class="container p-4">
        <div class="row justify-content-center align-center">
            <h1 class="text-center">Registro de Administrador</h1>
            <form action="<?php echo base_url('user/adminRegister') ?>" method="POST" class="w-75">
                <label class="d-block my-3">
                    Nome
                    <input type="text" name="nome" class="form-control">
                </label>
                <label class="d-block my-3"">
                    Email
                    <input type="text" name="email" class="form-control">
                </label>
                <label class="d-block mt-3"">
                    Senha
                    <input type="password" name="senha" class="form-control">
                </label>
                <input type="hidden" name="permissao" value="1">
                <input type="submit" value="Cadastrar" class="btn btn-success my-3">
            </form>
        </div>
    </div>
</body>