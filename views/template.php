<?php 
$conf = new Config();
$p = new Produtos();
$c = new Cidades();
$config = $conf->get();
$listHorarios = $conf->getAllHorarios();
$list_cidades = $c->getAll();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=320px">
  <meta name="description" content="Site de Delivery" />
  <meta name="author" content="Albicod Delivery" />
  <title><?=$config['titulo'] ?></title>
  <meta property="og:image" content="<?=BASE.'assets/img/'.$config['logo']; ?>">
  <meta property="og:image:type" content="image/png">
  <meta property="og:type" content="website">
  <meta name="robots" content="noindex">
  <meta name="robots" content="index, follow">
  <meta name="robots" content="noindex, nofollow">
  <link rel="icon" href="<?=BASE.'assets/img/'.$config['favicon']; ?>" type="image/x-icon"/>
  <link rel="stylesheet" href="<?=BASE; ?>assets/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?=BASE; ?>assets/css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?=BASE; ?>assets/css/style.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?=BASE; ?>assets/dataTable/dataTable.css">
  <script type="text/javascript" src="<?=BASE; ?>assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?=BASE; ?>assets/ckeditor/ckeditor.js"></script>
</head>
<body style="background-image: linear-gradient(to right, #191970 ,  #836FFF);"> 
  <div class="jumbotron" style="background-color: #191970;">
    <div class="container">
      <center>
        <a href="<?=BASE; ?>">
          <img class="img img-responsive" width="200" src="<?=BASE.'assets/img/'.$config['logo']; ?>">
        </a>
      </center>
    </div>
  </div>
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>

          <a class="navbar-brand" href="#" data-toggle="modal" data-target="#cart">
            <i class="fas fa-cart-plus"></i>
            <span><?php 
              $n = 0;
              if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $v) {
                  if (is_int($id)) {
                    $array = array($id);
                    $n += count($array);
                  }
                }
                echo $n;
              } else {
                echo $n;
              }
              ?>
            </span>
          </a>
          <!-- modal -->
          <div id="cart" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Carrinho de Compras</h4>
                </div>
                <div class="modal-body"> 
                <form method="GET" action="<?=BASE.'home/pedido'; ?>" target="_blank">
                  <?php if(!empty($_SESSION['cart'])): $total = 0; ?>
                    <?php foreach ($_SESSION['cart'] as $key => $value): 
                      if (is_int($key)):
                        $prod = $p->get($key);
                        $total += $prod['valor'] * $value;
                      ?>
                      <div class="row">
                        <div class="col-sm-3">
                          <img src="<?=BASE.'assets/img/produtos/'.$prod['imagem']; ?>" class="img-responsive" style="width:100%" alt="Image">
                        </div>
                        <div class="col-sm-9">
                          <input type="text" disabled="" value="<?=$prod['nome']; ?>" name="" class="form-control">
                          <input type="text" disabled="" value="<?=number_format($prod['valor'], 2, ',', '.'); ?>" name="" class="form-control">
                          <input type="number" min="1" value="<?=$value; ?>" class="form-control" disabled="">
                        </div>
                      </div>
                      <?php endif; 
                      if (is_string($key)):
                        $prod2 = $p->get(substr($key, 2));
                        echo "<label>Adicionais: ".$prod2['nome']."</label><br>";
                        foreach ($value as $id_add => $qt):
                          if (!empty($qt)):
                            $add = $p->getAdd($id_add);
                            $total += $add['valor']*$qt;
                            ?>
                            <div class="row">
                              <div class="col-sm-4">
                                <label>Item</label>
                                <input type="text" name="" value="<?=$add['item']; ?>" class="form-control" readonly="">
                              </div>
                              <div class="col-sm-4">
                                <label>Quantidade</label>
                                <input type="text" name="" value="<?=$qt; ?>" class="form-control" readonly="">
                              </div>
                              <div class="col-sm-4">
                                <label>Valor</label>
                                <input type="text" name="" value="<?=$add['valor']; ?>" class="form-control" readonly="">
                              </div>
                            </div>
                            <?php
                          endif;
                        endforeach;
                      endif;
                      ?>
                      
                      <hr>
                    <?php endforeach; ?>
                    <textarea class="form-control" name="descricao" placeholder="Descreva mais detalhes de seu pedido caso tenha"></textarea>
                    <input type="radio" name="forma_entrega" value="1" class="forma-entrega" id="entrega"> 
                    <label for="entrega">Entrega</label>
                    <input type="radio" name="forma_entrega" value="2" class="forma-entrega" id="loja"><label for="loja">Buscar na Loja</label>
                    <div class="formulario">
                      <input type="text" name="cliente" class="form-control" required="" placeholder="Cliente">
                      <input type="text" name="contato" class="form-control" required="" placeholder="Contato">
                      <!-- se clicar em entrega abrir esse formularios -->
                      <div class="formulario-interno" hidden="">
                        <input type="text" name="endereco" class="form-control endereco" placeholder="Endereço Completo">
                        <input type="text" name="bairro" class="form-control bairro" placeholder="Bairro">
                        <select class="form-control cidade" name="id_cidade">
                          <?php foreach ($list_cidades as $cidade): ?>
                            <option value="<?=$cidade['id']; ?>"><?=$cidade['cidade']; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <label>+ Taxa de Envio</label>
                        <input type="text" disabled="" value="<?=number_format($config['taxa_envio'], 2, '.', ''); ?>" id="taxa_envio" class="form-control">  
                        <!-- definir forma de pagamento -->
                        <input type="radio" name="forma_pagamento" value="1" class="forma-pagamento" id="dinheiro"> 
                        <label for="dinheiro">Dinheiro</label>
                        <input type="radio" name="forma_pagamento" value="2" class="forma-pagamento" id="cartao"> 
                        <label for="cartao">Cartão</label>
                        <!-- caso escolha pagar com dinheiro -->
                        <div class="formulario-interno2" hidden="">
                          <input type="text" name="troco" class="form-control price troco" placeholder="Troco para:">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-6">
                        <button class="btn btn-block btn-success success-cart" disabled="">Finalizar Compra</button>
                      </div>
                      <div class=" col-sm-6">
                        <h4>R$<?=number_format($total, 2, ',', '.'); ?></h4>
                      </div>
                    </div>
                  <?php endif; ?>
                </form>
                
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div>

      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li>
            
          </li>
          <li><a href="<?=BASE.'admin'; ?>"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <?php $this->loadViewInTemplate($viewName, $viewData); ?>
  <div class="jumbotron" style="background-image: linear-gradient(to right, #F4A460 ,  #FFD700);">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <img class="img img-responsive" src="<?=BASE.'assets/img/'.$config['logo']; ?>">
        </div>
        <div class="col-sm-4">
          <h3><?=$config['empresa']; ?></h3>
          <label>Endereço: <?=$config['endereco']; ?></label><br>
          <label>Bairro: <?=$config['bairro']; ?></label><br>
          <label>Cidade: <?=$config['cidade']; ?></label><br>
          <label>Tempo de Espera: <?=$config['tempo_espera']; ?></label><br>
        </div>
        <div class="col-sm-4">
          <h3>Horário de Funcionamento</h3>
          <?php foreach ($listHorarios as $key => $value): ?>
            <label><?=$value['descricao']; ?></label><br>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <footer class="container-fluid text-center">
    <p>Desenvolvido pela Albicod - <?=date('Y'); ?></p>
  </footer>
  <!-- AQUI COLOCAREMOS O FOOTER -->
  <script src="<?=BASE; ?>assets/js/bootstrap.min.js"></script>
  <script src="<?=BASE; ?>assets/js/jquery.mask.js"></script>
  <script src="<?=BASE; ?>assets/js/Chart_js/Chart.min.js"></script>
  <script src="<?=BASE; ?>assets/js/Chart_js/utils.js"></script>
  <script src="<?=BASE; ?>assets/dataTable/dataTable.js"></script>
  <script src="<?=BASE; ?>assets/js/config.js"></script>
  <script type="text/javascript" src="<?=BASE; ?>assets/js/script.js"></script>

</body>
</html>