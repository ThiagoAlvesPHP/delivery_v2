<?php 
$conf = new Config();
$config = $conf->get();
$usuario = $conf->getUsuario($_SESSION['cLogin']);
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title><?=$config['empresa'] ?></title>
      <link rel="icon" href="<?=BASE.'assets/img/'.$config['favicon']; ?>" type="image/x-icon"/>
      <link href="<?=BASE; ?>dist/css/styles.css" rel="stylesheet" />
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
  </head>
  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?=BASE.'admin'; ?>"><?=$config['empresa'] ?></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Consutar-->
        <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
        <!-- usuario-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?=$usuario['nome']; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?=BASE.'admin/up_usuario/'.$_SESSION['cLogin']; ?>">Meus Dados</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=BASE.'admin/logout'; ?>">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="<?=BASE.'admin'; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link" href="<?=BASE.'admin/usuarios'; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Usuários
                    </a>
                    <a class="nav-link" href="<?=BASE.'admin/cidades'; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Cidades
                    </a>
                    <a class="nav-link" href="<?=BASE.'admin/categorias'; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Categorias
                    </a>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Produtos
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">

                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?=BASE.'produtos/cadastro'; ?>">Cadastrar Produtos</a>
                        </nav>
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?=BASE.'produtos/itens'; ?>">Cadastrar Itens</a>
                        </nav>

                    </div>

                    <div class="sb-sidenav-menu-heading">Configurações</div>
                    <a class="nav-link" href="<?=BASE.'admin/config'; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Dados da Empresa
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <img class="img img-responsive" width="180" src="<?=BASE.'assets/img/'.$config['logo']; ?>">
            </div>
        </nav>
      </div>
      <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    </div>
    <!-- AQUI COLOCAREMOS O FOOTER -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?=BASE; ?>dist/js/scripts.js"></script>
    <script src="<?=BASE; ?>assets/js/jquery.mask.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="<?=BASE; ?>dist/assets/demo/datatables-demo.js"></script>
    <script src="<?=BASE; ?>assets/js/config.js"></script>
    <script src="<?=BASE; ?>assets/js/script.js"></script>
  </body>
</html>