<?php
class produtosController extends controller {
	public function __construct(){
		
	}
	//dashboard
	public function index() {
		$dados = array();		

		$this->loadAdmin('admin', $dados);
	}
	//cadastro de usuarios
	public function cadastro(){
		$dados = array();	
		$p = new Produtos();
		$c = new Categorias();
		$i = new Imagem();
		$dados['listCategorias'] = $c->getAll();

		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		
		//registrar
		if(!empty($post)){
			if (!empty($post)) {
				//verificando se imagem esta preenchida
				if (!empty($_FILES['imagem']['name'])) {
					//se a imagem for em png
					if ($_FILES['imagem']['type'] == 'image/png') {
						$url = 'assets/img/produtos/';
						$imagem = md5($_FILES['imagem']['tmp_name'].time().rand(0,999)).'.png';
						$post['imagem'] = $imagem;
						$i->png(600, 500, $url, $imagem);
						$p->set($post);
						header('Location: '.BASE.'produtos/cadastro');
					} else {
						$dados['error'] = 2;
					}
				} else {
					$dados['error'] = 1;
				}
			}
		}	

		$dados['list'] = $p->getAll();
		$this->loadAdmin('admin_produtos', $dados);
	}
	//atualizar protudo
	public function up($id){
		if (!empty($id)) {
			$dados = array();	
			$p = new Produtos();
			$c = new Categorias();
			$i = new Imagem();
			$dados['listCategorias'] = $c->getAll();
			$dados['produto'] = $p->get($id);

			$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		
			//atualizar produto
			if(!empty($post['nome'])){
				$post['id'] = $id;
				$p->up($post);
				header('Location: '.BASE.'produtos/up/'.$id);
			}

			if (!empty($_FILES['imagem']['name'])) {
				//se a imagem for em png
				if ($_FILES['imagem']['type'] == 'image/png') {
					$url = 'assets/img/produtos/';
					$post['id'] = $id;
					$imagem = md5($_FILES['imagem']['tmp_name'].time().rand(0,999)).'.png';
					$post['imagem'] = $imagem;
					if (file_exists($url.$dados['produto']['imagem'])) {
						unlink($url.$dados['produto']['imagem']);
					}
					$i->png(600, 500, $url, $imagem);
					$p->up($post);
					header('Location: '.BASE.'produtos/up/'.$id);
				} else {
					$dados['error'] = 2;
				}
			}

			$this->loadAdmin('admin_produtos_up', $dados);
		} else {
			header('Location: '.BASE.'admin');
		}
	}
	//cadastro de itens
	public function itens(){
		$dados = array();	
		$c = new Categorias();
		$u = new Usuarios();
		$p = new Produtos();

		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

		if (!$u->verificarNivel($_SESSION['cLogin'])) {
			header('Location: '.BASE.'admin');
		}

		//registrar item
		if(!empty($post)){
			$p->setItens($post);
			header('Location: '.BASE.'produtos/itens');
		}	
		//atualizar
		if(!empty($get['id_categoria'])){
			unset($get['url']);
			$p->upItem($get);
			header('Location: '.BASE.'produtos/itens');
		}	

		$dados['status'] = array(
			'1'=>'Ativo',
			'2'=>'Inativo'
		);
		$dados['list'] = $p->getAllItens();
		$dados['listCategorias'] = $c->getAll();
		$this->loadAdmin('admin_protudos_itens', $dados);
	}
	//cadastro e atualização de cidades
	public function ajax(){
		$p = new Produtos();
		$c = new Categorias();
		$i = new Imagem();
		$listCategorias = $c->getAll();

		$count = $p->count();
		//Receber a requisão da pesquisa 
		$requestData = $_REQUEST;

		$columns = array(
		    array(0 => 'id'),
		    array(1 => 'nome'),
		    array(2 => 'valor'),
		    array(3 => 'status'),
		    array(4 => 'id_categoria')
		);

		$qnt_linhas = $count;

		$result_usuarios = "
			SELECT produtos.*, 
			categorias.categoria
			FROM produtos 
			INNER JOIN categorias
			ON produtos.id_categoria = categorias.id
			WHERE 1=1";

		if( !empty($requestData['search']['value']) ) {   
		// se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
			$result_usuarios.=" AND (produtos.id LIKE '%".$requestData['search']['value']."%' ";    
			$result_usuarios.=" OR produtos.nome LIKE '%".$requestData['search']['value']."%' ";
			$result_usuarios.=" OR produtos.valor LIKE '%".$requestData['search']['value']."%' ";
			$result_usuarios.=" OR produtos.status LIKE '%".$requestData['search']['value']."%' ";
			$result_usuarios.=" OR produtos.id_categoria LIKE '%".$requestData['search']['value']."%' )";
		}

		$resultado_usuarios = $p->getAllAjax($result_usuarios);
		$totalFiltered = count($resultado_usuarios);

		//Ordenar o resultado
		$result_usuarios .= " ORDER BY ". implode(' AND ', $columns[$requestData['order'][0]['column']])."   ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$resultado_usuarios = $p->getAllAjax($result_usuarios);

		// Ler e criar o array de dados
		$dados = array();

		foreach ($resultado_usuarios as $key => $value) {
			$dado = array();
			$dado[] = '<a type="button" href="'.BASE.'produtos/up/'.$value['id'].'" class="btn btn-info"><i class="fas fa-edit"></i></a>';
			$dado[] = $value["nome"];
			$dado[] = 'R$'.number_format($value["valor"], 2, ',', '.');
			$dado[] = $value["status"];
			$dado[] = $value["categoria"];
			$dados[] = $dado;
		}	

		//Cria o array de informações a serem retornadas para o Javascript
		$json_data = array(
			"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
			"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
			"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
			"data" => $dados   //Array de dados completo dos dados retornados da tabela 
		);

		echo json_encode($json_data);
	}
}