<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Usuários</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Usuários</li>
            </ol>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Cadastrar Usuário</div>
                        <div class="card-footer">
                            <form method="POST">
                                <label>Usuário</label>
                                <input type="text" name="nome" class="form-control" required="">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" required="">
                                <label>Senha</label>
                                <input type="text" name="senha" class="form-control" required="">
                                <label>Tipo de Usuário</label><br>
                                <?php foreach ($definicao as $key => $value): ?>
                                    <input type="radio" name="definicao" value="<?=$key; ?>"> <?=$value; ?> |
                                <?php endforeach; ?>
                                <br><br>
                                <button class="btn btn-success btn-block">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="color: #000;">Lista de Usuários</div>
                        <div class="card-footer">
                            <div class="table table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ação</th>
                                            <th>Usuários</th>
                                            <th>Status</th>
                                            <th>Definição</th>
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
                                                                <input type="hidden" value="<?=$value['id'] ?>" name="id">
                                                                <label>Usuário</label>
                                                                <input type="text" name="nome" class="form-control" required="" value="<?=$value['nome']; ?>">
                                                                <label>E-mail</label>
                                                                <input type="email" name="email" class="form-control" required="" value="<?=$value['email']; ?>">
                                                                <label>Senha</label>
                                                                <input type="text" name="senha" class="form-control">
                                                                <label>Status</label><br>
                                                                <?php foreach ($status as $key3 => $value3): ?>
                                                                    <?php if($value['status'] == $key3): ?>
                                                                        <input checked="" type="radio" name="status" value="<?=$key3; ?>"> <?=$value3; ?> |
                                                                    <?php else: ?>
                                                                        <input type="radio" name="status" value="<?=$key3; ?>"> <?=$value3; ?> |
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                <br><br>
                                                                <label>Tipo de Usuário</label><br>
                                                                <?php foreach ($definicao as $key2 => $value2): ?>
                                                                    <?php if($value['definicao'] == $key2): ?>
                                                                        <input checked="" type="radio" name="definicao" value="<?=$key2; ?>"> <?=$value2; ?> |
                                                                    <?php else: ?>
                                                                        <input type="radio" name="definicao" value="<?=$key2; ?>"> <?=$value2; ?> |
                                                                    <?php endif; ?>
                                                                    
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
                                            <td><?=$value['nome']; ?></td>
                                            <td><?=($value['status'] == 1)?'Ativo':'Inativo'; ?></td>
                                            <td><?=($value['definicao'] == 1)?'Administrativo':'Colaborador'; ?></td>
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