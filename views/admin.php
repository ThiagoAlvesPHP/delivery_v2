<style type="text/css">
    .stretched-link{
        font-size: 25px;
    }
    .fa-whatsapp{
        color: #fff;
    }
    .modal-dialog{
        color: #000;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">TOTAL DE USUÁRIOS</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="<?=BASE.'admin/usuarios'; ?>"><?=$cUsuario; ?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">TOTAL DE PRODUTO</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#"><?=$cProduto; ?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">TOTAL DE PEDIDOS</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#"><?=$cPedido; ?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Pedidos</li>
            </ol>
            <h3>Pedidos do Dia - Pendentes</h3>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Ver</th>
                            <th>Pedido</th>
                            <th>Cliente</th>
                            <th>Contato</th>
                            <th>Entrega</th>
                            <th>Pagar</th>
                            <th>Troco</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <?php foreach ($listPedidosDay as $value): 
                        $produtos = $p->pedidoProdutos($value['id']);
                        ?>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#pedido<?=$value['id']; ?>">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <div class="modal" id="pedido<?=$value['id']; ?>">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">
                                                Cliente: <?=$value['cliente']; ?>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="table table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>Produto</th>
                                                        <th>Valor</th>
                                                        <th>Quantidade</th>
                                                        <th>Subtotal</th>
                                                      </tr>
                                                    </thead>
                                                    <?php 
                                                        $total = 0; 
                                                        foreach ($produtos as $prod): 
                                                        
                                                        $total += $prod['total'];
                                                        ?>
                                                    <tbody>
                                                      <tr>
                                                        <td><?=$prod['nome']; ?></td>
                                                        <td>R$<?=number_format($prod['valor'], 2, ',', '.'); ?></td>
                                                        <td><?=$prod['quantidade']; ?></td>
                                                        <td>R$<?=number_format($prod['total'], 2, ',', '.'); ?></td>
                                                      </tr>
                                                    </tbody>
                                                    <?php endforeach; 
                                                    if ($value['forma_entrega'] == 1) {
                                                        $total += floatval($config['taxa_envio']);
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                            <hr>
                                            Taxa de Envio: R$<?=($value['forma_entrega'] == 1)?number_format($config['taxa_envio'], 2, ',', '.'):number_format(0, 2, ',', '.'); ?>
                                            <hr>
                                            <label>Descrição</label>
                                            <textarea class="form-control" disabled=""><?=$value['descricao']; ?></textarea>
                                            <input type="text" name="" class="form-control" value="<?=$value['endereco']; ?>" disabled="">
                                            <input type="text" name="" class="form-control" value="<?=$value['bairro']; ?>" disabled="">
                                            <input type="text" name="" class="form-control" value="<?=$value['cidade']; ?>" disabled="">
                                            <br>
                                            <a class="btn btn-success" href="<?=BASE.'admin?id='.$value['id'].'&status=2'; ?>">
                                                Entregue
                                            </a>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </td>
                                <td><?=$value['id']; ?></td>
                                <td><?=$value['cliente']; ?></td>
                                <td><?=$value['contato']; ?>
                                    <a href="https://api.whatsapp.com/send?phone=55<?=$value['contato']; ?>" target="_blank">
                                        <i class="fab fa-whatsapp" title="Abrir Whatsapp"></i>
                                    </a>
                                </td>
                                <td><?=($value['forma_entrega'] == 1)?'Casa':'Loja'; ?></td>
                                <td><?=($value['forma_pagamento'] == 1)?'Dinheiro':'Cartão'; ?></td>
                                <td>R$<?=number_format($value['troco'], 2, ',', '.'); ?></td>
                                <td><?=($value['status'] == 1)?'Pendente':'Entregue'; ?></td>
                                <td>R$<?=number_format($total, 2, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
            <hr>
            <h3>Pedidos do Dia - Entregues</h3>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Ver</th>
                            <th>Pedido</th>
                            <th>Cliente</th>
                            <th>Contato</th>
                            <th>Entrega</th>
                            <th>Pagar</th>
                            <th>Troco</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <?php foreach ($listPedidosEntregues as $value): 
                        $produtos = $p->pedidoProdutos($value['id']);
                        ?>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#pedido<?=$value['id']; ?>">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <div class="modal" id="pedido<?=$value['id']; ?>">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">
                                                Cliente: <?=$value['cliente']; ?>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="table table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>Produto</th>
                                                        <th>Valor</th>
                                                        <th>Quantidade</th>
                                                        <th>Subtotal</th>
                                                      </tr>
                                                    </thead>
                                                    <?php foreach ($produtos as $prod): 
                                                        $sub = $prod['quantidade'] * $prod['valor'];
                                                        if ($value['forma_entrega'] == 1) {
                                                            $sub += floatval($config['taxa_envio']);
                                                        }
                                                        ?>
                                                    <tbody>
                                                      <tr>
                                                        <td><?=$prod['nome']; ?></td>
                                                        <td>R$<?=number_format($prod['valor'], 2, ',', '.'); ?></td>
                                                        <td><?=$prod['quantidade']; ?></td>
                                                        <td>R$<?=number_format($sub, 2, ',', '.'); ?></td>
                                                      </tr>
                                                    </tbody>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
                                            <hr>
                                            Taxa de Envio: R$<?=($value['forma_entrega'] == 1)?number_format($config['taxa_envio'], 2, ',', '.'):number_format(0, 2, ',', '.'); ?>
                                            <hr>
                                            <label>Descrição</label>
                                            <textarea class="form-control" disabled=""><?=$value['descricao']; ?></textarea>
                                            <input type="text" name="" class="form-control" value="<?=$value['endereco']; ?>" disabled="">
                                            <input type="text" name="" class="form-control" value="<?=$value['bairro']; ?>" disabled="">
                                            <input type="text" name="" class="form-control" value="<?=$value['cidade']; ?>" disabled="">
                                            <br>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </td>
                                <td><?=$value['id']; ?></td>
                                <td><?=$value['cliente']; ?></td>
                                <td><?=$value['contato']; ?>
                                    <a href="https://api.whatsapp.com/send?phone=55<?=$value['contato']; ?>" target="_blank">
                                        <i class="fab fa-whatsapp" title="Abrir Whatsapp"></i>
                                    </a>
                                </td>
                                <td><?=($value['forma_entrega'] == 1)?'Casa':'Loja'; ?></td>
                                <td><?=($value['forma_pagamento'] == 1)?'Dinheiro':'Cartão'; ?></td>
                                <td>R$<?=number_format($value['troco'], 2, ',', '.'); ?></td>
                                <td><?=($value['status'] == 1)?'Pendente':'Entregue'; ?></td>
                                <td>R$<?=number_format($sub, 2, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </main>
</div>