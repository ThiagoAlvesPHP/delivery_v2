<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Configurações</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Configurações</li>
            </ol>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="color: #000;">Dados da Empresa</div>
                        <div class="card-footer">
                            <form method="POST" style="color: #000;">
                                <label>Empresa</label>
                                <input type="text" name="empresa" class="form-control" required="" value="<?=$get['empresa']; ?>">
                                <label>Endereço</label>
                                <input type="text" name="endereco" class="form-control" required="" value="<?=$get['endereco']; ?>">
                                <label>Bairro</label>
                                <input type="text" name="bairro" class="form-control" required="" value="<?=$get['bairro']; ?>">
                                <label>Cidade</label>
                                <select class="form-control" name="id_cidade">
                                    <?php foreach ($list_cidades as $key => $value): ?>
                                        <?php if($get['id_cidade'] == $value['id']): ?>
                                            <option selected="" value="<?=$value['id']; ?>">
                                                <?=$value['cidade']; ?>
                                            </option>
                                        <?php else: ?>
                                            <option value="<?=$value['id']; ?>">
                                                <?=$value['cidade']; ?>
                                            </option>
                                        <?php endif; ?>
                                        
                                    <?php endforeach; ?>
                                </select>
                                <label>Tempo de espera</label>
                                <input type="text" name="tempo_espera" class="form-control" required="" value="<?=$get['tempo_espera']; ?>">
                                <label>Título do Site</label>
                                <input type="text" name="titulo" class="form-control" required="" value="<?=$get['titulo']; ?>">
                                <label>Taxa de Envio</label>
                                <input type="text" name="taxa_envio" class="form-control price" required="" value="<?=$get['taxa_envio']; ?>">
                                <label>Whatsapp</label>
                                <input type="text" name="whatsapp" class="form-control" required="" value="<?=$get['whatsapp']; ?>">
                                <br>
                                <button class="btn btn-primary btn-block">Atualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="color: #000;">Logo</div>
                        <div class="card-footer">
                            <form method="POST" enctype="multipart/form-data">
                                <?php if(!empty($erro)): ?>
                                    <div class="alert alert-danger">
                                        <b>
                                            Fortato de arquivo inválido!
                                        </b>
                                    </div>
                                <?php endif; ?>
                                <img src="<?=BASE.'assets/img/'.$get['logo']; ?>" width="200" class="mx-auto d-block img-thumbnail">
                                <br>
                                <input type="file" name="logo" class="form-control">
                                <br>
                                <button class="btn btn-primary">Atualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="color: #000;">Favicon</div>
                        <div class="card-footer">
                            <form method="POST" enctype="multipart/form-data">
                            <?php if(!empty($erro)): ?>
                                <div class="alert alert-danger">
                                    <b>
                                        Fortato de arquivo inválido!
                                    </b>
                                </div>
                            <?php endif; ?>
                            <img src="<?=BASE.'assets/img/'.$get['favicon']; ?>" width="200" class="mx-auto d-block img-thumbnail">
                            <br>
                            <input type="file" name="favicon" class="form-control">
                            <br>
                            <button class="btn btn-primary">Atualizar</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Cadastrar Horários de Funcionamento</div>
                        <div class="card-footer">
                            <form method="POST">
                                <label>Descrição</label>
                                <input type="text" name="descricao" class="form-control" required="">
                                <br>
                                <button class="btn btn-success btn-block">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="color: #000;">Lista de Horários</div>
                        <div class="card-footer">
                            <div class="table table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ação</th>
                                            <th>Descrição</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($horarios as $key => $value): ?>
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
                                                                <label>Descrição</label>
                                                                <input type="text" name="descricao" class="form-control" required="" value="<?=$value['descricao'] ?>">
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
                                            <td><?=$value['descricao']; ?></td>
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