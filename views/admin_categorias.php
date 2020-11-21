<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Categorias</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Categorias</li>
            </ol>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Cadastrar Categorias</div>
                        <div class="card-footer">
                            <form method="POST">
                                <label>Categoria</label>
                                <input type="text" name="categoria" class="form-control" required="" autofocus="">
                                <br>
                                <button class="btn btn-success btn-block">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="color: #000;">Lista de Categorias</div>
                        <div class="card-footer">
                            <div class="table table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ação</th>
                                            <th>Categorias</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($list as $key => $value): ?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal<?=$value['id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <div id="modal<?=$value['id']; ?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="card-footer">
                                                            <form method="GET">
                                                                <label>Categoria</label>
                                                                <input type="hidden" value="<?=$value['id'] ?>" name="id">
                                                                <input type="text" value="<?=$value['categoria'] ?>" name="categoria" class="form-control" required="">
                                                                <br>
                                                                <button class="btn btn-primary btn-block">Atualizar</button>
                                                            </form>
                                                        </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </td>
                                            <td><?=$value['categoria']; ?></td>
                                        </tr>
                                    </tbody>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>