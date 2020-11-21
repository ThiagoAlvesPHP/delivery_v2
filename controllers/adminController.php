<?php
class adminController extends controller {
	public function __construct(){
		if (empty($_SESSION['cLogin'])) {
			header('Location: '.BASE.'login');
		}
	}
	//dashboard
	public function index() {
		$dados = array();		
		$usuarios = new Usuarios();
		$produtos = new Produtos();
		$pedidos = new Pedidos();
		$config = new Config();
		$dados['p'] = new Pedidos();
		$dados['config'] = $config->get();

		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

		//alterar status de pedido
		if (!empty($get['status'])) {
			unset($get['url']);
			$pedidos->up($get);
			header('Location: '.BASE.'admin');
		}

		$dados['listPedidosDay'] = $pedidos->getAll(date('Y-m-d'), 1);
		$dados['listPedidosEntregues'] = $pedidos->getAll(date('Y-m-d'), 2);

		$dados['cUsuario'] = $usuarios->count();
		$dados['cProduto'] = $produtos->count();
		$dados['cPedido'] = $pedidos->count();
		$this->loadAdmin('admin', $dados);
	}
	//cadastro de usuarios
	public function usuarios(){
		$dados = array();	
		$u = new Usuarios();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

		if (!$u->verificarNivel($_SESSION['cLogin'])) {
			header('Location: '.BASE.'admin');
		}

		$dados['definicao'] = array(
			'1'=>'Administrador',
			'2'=>'Colaborador'
		);
		$dados['status'] = array(
			'1'=>'Ativo',
			'2'=>'Inativo'
		);
		//registrar
		if(!empty($post)){
			$u->set($post);
			header('Location: '.BASE.'admin/usuarios');
		}	
		//atualizar
		if(!empty($get['nome'])){
			unset($get['url']);
			if (empty($get['senha'])) {
				unset($get['senha']);
			} else {
				$get['senha'] = md5($get['senha']);
			}
			$u->up($get);
			header('Location: '.BASE.'admin/usuarios');
		}	

		$dados['list'] = $u->getAll();
		$this->loadAdmin('admin_usuarios', $dados);
	}
	//cadastro e atualização de cidades
	public function cidades(){
		$dados = array();	
		$c = new Cidades();
		$u = new Usuarios();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

		if (!$u->verificarNivel($_SESSION['cLogin'])) {
			header('Location: '.BASE.'admin');
		}

		//registrar
		if(!empty($post)){
			$c->set($post);
			header('Location: '.BASE.'admin/cidades');
		}	
		//atualizar
		if(!empty($get['cidade'])){
			unset($get['url']);
			$c->up($get);
			header('Location: '.BASE.'admin/cidades');
		}	

		$dados['list'] = $c->getAll();
		$this->loadAdmin('admin_cidades', $dados);
	}
	//cadastro de cidades
	public function categorias(){
		$dados = array();	
		$c = new Categorias();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		//registrar
		if(!empty($post)){
			$c->set($post);
			header('Location: '.BASE.'admin/categorias');
		}	
		//atualizar
		if(!empty($get['categoria'])){
			unset($get['url']);
			$c->up($get);
			header('Location: '.BASE.'admin/categorias');
		}	

		$dados['list'] = $c->getAll();
		$this->loadAdmin('admin_categorias', $dados);
	}
	//configurações - dados da empresa
	public function config(){
		$dados = array();	
		$c = new Config();
		$cid = new Cidades();
		$u = new Usuarios();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		$dados['get'] = $c->get();
		//verificar nivel de usuario
		if (!$u->verificarNivel($_SESSION['cLogin'])) {
			header('Location: '.BASE.'admin');
		}
		//atualizar config
		if(!empty($post['empresa'])){
			$c->up($post);
			header('Location: '.BASE.'admin/config');
		}
		//atualizar logo
		if (!empty($_FILES['logo'])) {
			//verifica se arquivo é png
			if ($_FILES['logo']['type'] == 'image/png') {
				if (file_exists('assets/img/'.$dados['get']['logo'])) {
					unlink('assets/img/'.$dados['get']['logo']);
				}
				$post['logo'] = md5($_FILES['logo']['tmp_name'].time().rand(0,999)).'.png';
				$c->up($post);
				move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/img/'.$post['logo']);
				header('Location: '.BASE.'admin/config');
			} else {
				$dados['erro'] = true;
			}
		}
		//atualizar favicon
		if (!empty($_FILES['favicon'])) {
			//verifica se arquivo é png
			if ($_FILES['favicon']['type'] == 'image/png') {
				if (file_exists('assets/img/'.$dados['get']['favicon'])) {
					unlink('assets/img/'.$dados['get']['favicon']);
				}
				$post['favicon'] = md5($_FILES['favicon']['tmp_name'].time().rand(0,999)).'.png';
				$c->up($post);
				move_uploaded_file($_FILES['favicon']['tmp_name'], 'assets/img/'.$post['favicon']);
				header('Location: '.BASE.'admin/config');
			} else {
				$dados['erro'] = true;
			}
		}
		//registrar horarios
		if(!empty($post['descricao'])){
			$c->setHorario($post);
			header('Location: '.BASE.'admin/config');
		}
		//atualizar
		if(!empty($get['descricao'])){
			unset($get['url']);
			$c->upHorario($get);
			header('Location: '.BASE.'admin/config');
		}

		$dados['horarios'] = $c->getAllHorarios();
		$dados['list_cidades'] = $cid->getAll();
		$this->loadAdmin('admin_config', $dados);
	}
	//alterar dados do usuario
	public function up_usuario($id){
		$dados = array();	
		$u = new Usuarios();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
		//verifificar se é o usuario que esta alterando os proprios dados
		if ($_SESSION['cLogin'] <> $id) {
			header('Location: '.BASE.'admin/up_usuario/'.$_SESSION['cLogin']);
		}
		//atualizar
		if(!empty($post)){
			$post['id'] = $id;
			if (empty($post['senha'])) {
				unset($post['senha']);
			} else {
				$post['senha'] = md5($post['senha']);
			}
			$u->up($post);
			header('Location: '.BASE.'admin/up_usuario/'.$id);
		}
		
		$dados['value'] = $u->get($id);
		$this->loadAdmin('admin_usuario_up', $dados);
	}
	//deslogar do sistema
	public function logout(){
		//deslogar administrador
		if (!empty($_SESSION['cLogin'])) {
			unset($_SESSION['cLogin']);
			header('Location: '.BASE.'login');
		}
	}
}