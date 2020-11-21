<!-- listar produtos -->
<div class="container bg-3 text-center"> 
  <h2 style="color: #fff;">Nossos Produtos</h2><br>
  <hr>
  <h4 style="color: #fff;"><i>Categorias</i></h4>
  <div class="row"> 
    <?php foreach ($categorias as $key => $value): ?>
      <div class="col-sm-2 categorias">
        <button value="<?=$value['id']; ?>" class="btn btn-danger btn-block id_categoria"><?=$value['categoria']; ?></button>
      </div>
    <?php endforeach; ?>
  </div>
  <hr>
  <div class="row" id="lista-produtos-categoria">
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
                    <img src="<?=BASE.'assets/img/produtos/'.$value['imagem']; ?>" class="img-responsive img-produto" style="width:100%" alt="Image">
                  </div>
                  <div class="col-sm-8">
                    <form method="POST" class="addtocartform">
                      <input type="hidden" name="id_produto" value="<?=$value['id']; ?>" class="id_produto">
                      <input type="text" value="<?=number_format($value['valor'], 2, '.', ''); ?>" class="form-control valor" disabled>
                      <br>

                      <button class="bt-acao" data-action="decrease">-</button>
                      <input type="number" min="1" value="1" name="quantidade" class="quantidade" readonly="">
                      <button class="bt-acao" data-action="increase">+</button>

                      <hr>
                      <?php if(!empty($listAcrescimos)): ?>
                      <label>Acrescimos</label>
                      <div class="table table-responsive">
                        <table class="table table-hover">
                          <?php foreach ($listAcrescimos as $a): ?>
                            <?php if($value['id_categoria'] == $a['id_categoria']): ?>
                              <tbody>
                                <td>R$<span><?=$a['valor']; ?></span></td>
                                <td><?=$a['item']; ?></td>
                                <td>
                                  <button class="btn-acrescimo" data-action="decrease">-</button>
                                  <input type="number" min="0" name="qt_acrescimo[<?=$a['id']; ?>]" class="qt_acrescimo" value="0" readonly="">
                                  <button class="btn-acrescimo" data-action="increase">+</button>
                                </td>
                              </tbody>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </table>
                      </div>
                      <?php endif; ?>
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
  </div>
</div>
<br><br>