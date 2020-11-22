<?php
class Pedidos extends model{
	//cadastrar pedido
	public function set($post, $produtos){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO pedidos SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();

		$id_pedido = $this->db->lastInsertId();

		foreach ($produtos as $id_produto => $quantidade) {
			if (is_int($id_produto)) {
				$this->setProdutos($id_pedido, $id_produto, $quantidade);
			}
		}

		return $id_pedido;
	}
	//cadastrar orcamento
	public function setProdutos($id_pedido, $id_produto, $quantidade){
		$sql = $this->db->query("
			INSERT INTO pedidos_produtos 
			SET id_pedido = '{$id_pedido}',
			id_produto = '{$id_produto}',
			quantidade = '{$quantidade}'
			");
	}
	//contar produtos
	public function get($id){
		$sql = $this->db->query("SELECT * FROM pedidos WHERE id = '{$id}' ");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//selecionar cidades
	public function getAll($data = '', $status = ''){
		$sql = "
			SELECT 
			pedidos.*, 
			cidades.cidade 
			FROM pedidos
			INNER JOIN cidades
			ON pedidos.id_cidade = cidades.id
			WHERE 1=1 
		";

		if (!empty($data)) {
			$sql .= " AND DATE(pedidos.data_registro) = '{$data}' ";
		}
		if (!empty($status)) {
			$sql .= " AND pedidos.status = '{$status}' ";
		}

		$sql .= " ORDER BY id ASC";
		$array = array();
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		return $array;
	}
	//atualizar configurações
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE pedidos SET {$fields} WHERE id = '{$post['id']}' ");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar produtos ajax
	public function getAllAjax($sql){
		$sql = $this->db->prepare($sql);
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//pegar produtos de pedido
	public function pedidoProdutos($id_pedido){
		
		$array = array();
		$sql = $this->db->query("
			SELECT
			    pedidos_produtos.*,
			    produtos.nome,
			    produtos.valor,
                (produtos.valor*pedidos_produtos.quantidade) as total
			FROM
			    pedidos_produtos
			INNER JOIN 
				produtos
			ON
				pedidos_produtos.id_produto = produtos.id 
			WHERE id_pedido = '{$id_pedido}' ");

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		return $array;
	}
	//contar produtos
	public function count(){
		$sql = $this->db->query("SELECT COUNT(*) as c FROM pedidos");
		$sql =  $sql->fetch(PDO::FETCH_ASSOC);
		return $sql['c'];
	}
}