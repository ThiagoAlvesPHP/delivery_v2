<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Produtos</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Produtos</li>
                <li class="breadcrumb-item active">Cadastrar</li>
            </ol>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Cadastrar Produto</div>
                        <div class="card-footer">
                            <?php if(!empty($error)): ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <?=($error == 1)?'Nenhuma imagem foi enviada!':'Formato de arquivo invalido!'; ?>
                                </div>
                            <?php endif; ?>
                            <form method="POST" enctype="multipart/form-data">
                                <label>Produto</label>
                                <input type="text" name="nome" class="form-control" required="">
                                <label>Descrição</label>
                                <textarea name="descricao" class="form-control"></textarea>
                                <label>Valor</label>
                                <input type="text" name="valor" class="form-control price" required="">
                                <label>Imagem <small>Formato PNG - Tamanho 400 x 300</small></label>
                                <input type="file" name="imagem" class="form-control" required="">
                                <label>Categoria</label>
                                <select name="id_categoria" class="form-control">
                                    <?php foreach ($listCategorias as $key => $value): ?>
                                        <option value="<?=$value['id']; ?>"><?=$value['categoria']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                <button class="btn btn-success btn-block">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="color: #000;">Lista de Produtos</div>
                        <div class="card-footer">
                            <div class="table-responsive">
                                <table class="table table-responsive" id="produtos">
                                    <thead>
                                        <tr>
                                            <th>Ação</th>
                                            <th>Nome</th>
                                            <th>Valor</th>
                                            <th>Status</th>
                                            <th>Categoria</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>