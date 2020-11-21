<?php
class Produtos extends model{
	//registrar produto
	public function set($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO produtos SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar produto por id
	public function get($id){
		$sql = $this->db->query("SELECT * FROM produtos WHERE id = '{$id}' ");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//selecionar adicional por produto
	public function getAdd($id){
		$sql = $this->db->query("SELECT * FROM produtos_acrescimos WHERE id = '{$id}' ");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//selecionar produtos
	public function getAll(){
		$array = array();
		$sql = $this->db->query("
			SELECT 
			produtos.*, 
			categorias.categoria 
			FROM produtos
			INNER JOIN categorias
			ON produtos.id_categoria = categorias.id
			");

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		return $array;
	}
	//selecionar produtos por categoria
	public function getAllCategoria($id){
		$array = array();
		$sql = $this->db->query("
			SELECT 
			produtos.*, 
			categorias.categoria 
			FROM produtos
			INNER JOIN categorias
			ON produtos.id_categoria = categorias.id
			WHERE produtos.id_categoria = '{$id}'
			");

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
		$sql = $this->db->prepare("UPDATE produtos SET {$fields} WHERE id = '{$post['id']}' ");

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
	//contar produtos
	public function count(){
		$sql = $this->db->query("SELECT COUNT(*) as c FROM produtos");
		$sql =  $sql->fetch(PDO::FETCH_ASSOC);
		return $sql['c'];
	}

	//registrar itens
	public function setItens($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO produtos_acrescimos SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//atualizar itens
	public function upItem($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE produtos_acrescimos SET {$fields} WHERE id = '{$post['id']}' ");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar itens
	public function getAllItens(){
		$array = array();
		$sql = $this->db->query("
			SELECT 
			produtos_acrescimos.*, 
			categorias.categoria 
			FROM produtos_acrescimos
			INNER JOIN categorias
			ON produtos_acrescimos.id_categoria = categorias.id
			");

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		return $array;
	}
}