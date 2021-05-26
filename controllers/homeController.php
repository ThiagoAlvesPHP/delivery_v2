<?php
class homeController extends controller {
	public function index() {
		$dados = array();	
		$p = new Produtos();	
		$c = new Categorias();

		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		//adicionando produto ao carrinho
		if (!empty($post['id_produto'])) {

			if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            if(isset($_SESSION['cart'][$post['id_produto']])) {
                $_SESSION['cart'][$post['id_produto']] += $post['quantidade'];
                if (!empty($post['qt_acrescimo'])) {
                	foreach ($post['qt_acrescimo'] as $key => $value) {
                		$_SESSION['cart']['ac'.$post['id_produto']][$key] += $value;
                	}
                }
            } else {
                $_SESSION['cart'][$post['id_produto']] += $post['quantidade'];
                if (!empty($post['qt_acrescimo'])) {
                	foreach ($post['qt_acrescimo'] as $key => $value) {
                		$_SESSION['cart']['ac'.$post['id_produto']][$key] += $value;
                	}
                }
            }
            header('Location: '.BASE);
		}

		$dados['categorias'] = $c->getAll();
		$dados['listProdutos'] = $p->getAll();
		$dados['listAcrescimos'] = $p->getAllItens();
		$this->loadTemplate('home', $dados);
	}
	//gerar pedido tanto para db quanto para zap
	public function pedido(){
		if (!empty($_SESSION['cart'])) {
			$c = new Config();
			$p = new Pedidos();
			$prod = new Produtos();
			$city = new Cidades();

			$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
			$cidade = $city->get($get['id_cidade']);
			$config = $c->get();

			$zap = "https://api.whatsapp.com/send?phone=55".$config['whatsapp']."&text=";

			unset($get['url']);
			$pagamento = '';
			$total = 0;
			$taxa = 0;
			$troco = 0;
			
			//verificar se forma de entrega foi preenchido
			if (!empty($get['forma_entrega'])) {
				//se a forma de entrega for na casa do cliente
				if ($get['forma_entrega'] == 1) {
					//se forma de pagamento for dinheiro ou cartão preencher a variavel pagamento
					if (!empty($get['forma_pagamento'])) {
						if ($get['forma_pagamento'] == 1) {
							$pagamento = "Dinheiro";
						} else {
							$pagamento = "Cartão";
						}
					}
					$entrega = 'Entegar na casa do cliente';
					$total += floatval($config['taxa_envio']);
					$taxa = floatval($config['taxa_envio']);
					//verificar se houve alguma descrição
					if (!empty($get['descricao'])) {
						$descricao = $get['descricao'];
					} else {
						$descricao = "Nenhuma Descrição";
					}
					//selecionando produtos e calculando o total
					foreach ($_SESSION['cart'] as $key => $qt) {
						$prod1 = $prod->get($key);
						$troco += $prod1['valor']*$qt;
					}	
					$troco += $total;

					//se valor enviado no campo troco for maior que total continua
					if ($get['troco'] >= $troco) {
						$troco = $get['troco'] - $troco;
						$code = $p->set($get, $_SESSION['cart']);

						$msg = "*A ".$config['empresa']." agradeçe seu pedido*%0A%0A*".$entrega."*%0A*Pedido:* ".$code." %0A*Cliente:* ".$get['cliente']."%0A*Contato:* ".$get['contato']."%0A*Endereço:* ".$get['endereco']."%0A*Bairro:* ".$get['bairro']."%0A*Cidade:* ".$cidade['cidade']."%0A*Forma de Pagamento:* ".$pagamento."%0A*Troco:* R$".number_format($troco, 2, ',', '.')."%0A*Descrição:* ".$descricao."%0A";

						foreach ($_SESSION['cart'] as $id_produto => $quantidade) {
							$produto = $prod->get($id_produto);
							$total += $quantidade*$produto['valor'];
							$msg .= "*".$quantidade." ".$produto['nome']."* - *Valor: R$".number_format($produto['valor']*$quantidade, 2, ',', '.')."*%0A";
						}

						$msg .= "*Taxa de Entrega:* R$".number_format($taxa, 2, ',','.')."%0A-----------------------------------------------%0A%0A%0A%0A*Total: R$".number_format($total, 2, ',', '.')."*%0A%0AAgradecemos a Preferência!";

						$zap .= $msg;
						
						//redirecionamento
						unset($_SESSION['cart']);
						echo '<script> window.location.assign("'.$zap.'"); </script>';
					} else {
						echo '<script> alert("Valor inserido em troco é invalido"); window.close(); </script>';
					}
				} 
				//se a forma de entrega for para pegar na loja
				else {
					$entrega = 'Cliente vem pegar na loja';
					//verificar se houve alguma descrição
					if (!empty($get['descricao'])) {
						$descricao = $get['descricao'];
					} else {
						$descricao = "Nenhuma Descrição";
					}

					$code = $p->set($get, $_SESSION['cart']);

					$msg = "*A ".$config['empresa']." agradeçe seu pedido*%0A%0A*".$entrega."*%0A*Pedido:* ".$code." %0A*Cliente:* ".$get['cliente']."%0A*Contato:* ".$get['contato']."%0A*Endereço:* ".$get['endereco']."%0A*Bairro:* ".$get['bairro']."%0A*Cidade:* ".$cidade['cidade']."%0A*Descrição:* ".$descricao."%0A";

					foreach ($_SESSION['cart'] as $id_produto => $quantidade) {
						$produto = $prod->get($id_produto);
						$total += $quantidade*$produto['valor'];
						$msg .= "*".$quantidade." ".$produto['nome']."* - *Valor: R$".number_format($produto['valor']*$quantidade, 2, ',', '.')."*%0A";
					}

					$msg .= "*Taxa de Entrega:* R$".number_format($taxa, 2, ',','.')."%0A-----------------------------------------------%0A%0A%0A%0A*Total: R$".number_format($total, 2, ',', '.')."*%0A%0AAgradecemos a Preferência!";

					$zap .= $msg;
					
					//redirecionamento
					unset($_SESSION['cart']);
					echo '<script> window.location.assign("'.$zap.'"); </script>';

				}
			} 
			//se nenhuma forma de entrega for definida dar um alert e fecha a pagina
			else {
				echo '<script> alert("Nenhuma forma de entrega foi definida"); window.close(); </script>';
			}
			
		} else {
			header('Location: '.BASE);
		}
	}
	//requisição ajax produtos por categoria
	public function ajax(){
		$dados = array();	
		$p = new Produtos();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		$dados['listProdutos'] = array();

		if (!empty($post['id_categoria'])) {
			$dados['listProdutos'] = $p->getAllCategoria($post['id_categoria']);
		}
		
		$this->loadView('ajaxCategoria', $dados);
		
	}

	public function logout(){
		//deslogar administrador
		if (!empty($_SESSION['cLogin'])) {
			unset($_SESSION['cLogin']);
			header('Location: '.BASE.'login');
		}
	}
}