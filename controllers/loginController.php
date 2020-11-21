<?php
class loginController extends controller {

	public function __construct(){
		if (!empty($_SESSION['cLogin'])) {
			header('Location: '.BASE);
		}
	}

	public function index() {
		$dados = array();
		$u = new Usuarios();
		$c = new Config();

		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		//verifica se foi enviado alguma informação no post
		if (!empty($post)) {
		    if ($u->login($post)) {
				header('Location: '.BASE.'admin');
			} else {
				$dados['error'] = '<div class="alert alert-danger">Login e/ou senha incorretos</div>';
			}
		}

		$dados['config'] = $c->get();
		$this->loadView('login', $dados);
	}
}