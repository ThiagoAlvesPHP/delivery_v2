<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Usuário</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol>
            <div class="card bg-info text-white mb-4">
                <div class="card-body">Atualizar Usuário</div>
                <div class="card-footer">
                    <form method="POST">
                        <label>Usuário</label>
                        <input type="text" name="nome" class="form-control" required="" value="<?=$value['nome']; ?>">
                        <label>E-mail</label>
                        <input type="email" name="email" class="form-control" required="" value="<?=$value['email']; ?>">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control">
                        <br>
                        <button class="btn btn-primary btn-block">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>