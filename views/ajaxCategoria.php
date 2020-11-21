<?php foreach ($listProdutos as $key => $value): ?>
  <div class="col-sm-3 produtos" data-toggle="modal" data-target="#descricao<?=$value['id']; ?>">
    <div class="card well">
      <h5 class="card-title"><?=$value['nome']; ?></h5>
      <img src="<?=BASE.'assets/img/produtos/'.$value['imagem']; ?>" class="img-responsive card-img-top" style="width:100%" alt="Image">
      <div class="card-body">
        <br>
        <p class="card-text">
          <?=$value['categoria']; ?><br>
          <strong style="font-size: 20px;">
            R$<?=number_format($value['valor'], 2, ',', '.'); ?>
          </strong>
          <br>
        </p>
        <a href="#" class="btn btn-primary">Adicionar</a>
      </div>
    </div>
  </div>
  <!-- modal -->
  <div id="descricao<?=$value['id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><?=$value['nome']; ?></h4>
          <p><?=$value['categoria']; ?></p>
          <p><?=$value['descricao'] ?></p>
        </div>
        <div class="modal-body">
          <p>
            <div class="row">
              <div class="col-sm-4">
                <img src="<?=BASE.'assets/img/produtos/'.$value['imagem']; ?>" class="img-responsive" style="width:100%" alt="Image">
              </div>
              <div class="col-sm-8">
                <form method="POST">
                  <input type="hidden" name="id_produto" value="<?=$value['id']; ?>" class="id_produto">
                  <input type="text" value="<?=number_format($value['valor'], 2, '.', ''); ?>" class="form-control valor" disabled>
                  <br>
                  <input type="number" min="1" value="1" name="quantidade" class="form-control quantidade">
                  <h3 class="subtotal">Total: R$<span><?=number_format($value['valor'], 2, ',', '.'); ?></span></h3>
                  <button class="btn btn-success">Adicionar</button>
                </form>
              </div>
            </div>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>