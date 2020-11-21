<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Itens</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Itens</li>
            </ol>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Cadastrar Itens</div>
                        <div class="card-footer">
                            <form method="POST">
                                <label>Categoria</label>
                                <select name="id_categoria" class="form-control">
                                    <?php foreach ($listCategorias as $key => $value): ?>
                                        <option value="<?=$value['id']; ?>"><?=$value['categoria']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label>Item</label>
                                <input type="text" name="item" class="form-control" required="">
                                <label>Valor</label>
                                <input type="text" name="valor" class="form-control price" required="">
                                <br>
                                <button class="btn btn-success btn-block">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="color: #000;">Lista de Itens</div>
                        <div class="card-footer">
                            <div class="table table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ação</th>
                                            <th>Categoria</th>
                                            <th>Item</th>
                                            <th>Valor</th>
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
                                                                <input type="hidden" name="id" value="<?=$value['id']; ?>">
                                                                <label>Categoria</label>
                                                                <select name="id_categoria" class="form-control">
                                                                    <?php foreach ($listCategorias as $value2): ?>
                                                                        <?php if($value['id_categoria'] == $value2['id']): ?>
                                                                            <option selected="" value="<?=$value2['id']; ?>"><?=$value2['categoria']; ?></option>
                                                                        <?php else: ?>
                                                                            <option value="<?=$value2['id']; ?>"><?=$value2['categoria']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <label>Item</label>
                                                                <input type="text" name="item" class="form-control" value="<?=$value['item']; ?>" required="">
                                                                <label>Valor</label>
                                                                <input type="text" value="<?=$value['valor']; ?>" name="valor" class="form-control price" required="">
                                                                <label>Status</label><br>
                                                                <?php foreach ($status as $id => $s): ?>
                                                                    <input <?=($value['status'] == $id)?'checked=""':''; ?> type="radio" name="status" value="<?=$id; ?>"><?=$s; ?>
                                                                <?php endforeach; ?>
                                                                <br><br>
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
                                            <td><?=$value['item']; ?></td>
                                            <td>R$<?=number_format($value['valor'], 2, ',', '.'); ?></td>
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