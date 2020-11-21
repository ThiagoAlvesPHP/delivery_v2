<?php
class notfoundController extends controller {
	public function index() {
		$this->loadTemplate('404');
	}
	//menu
	public function menu(){
		$dados = array();
		$c = new Config();
		
		$dados['config'] = $c->get();
		$dados['categorias'] = (new Categorias())->getAll();
		$this->loadView('menu', $dados);
	}
}