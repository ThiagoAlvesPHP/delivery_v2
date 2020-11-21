<?php
class Cidades extends model{
	//registrar cidades
	public function set($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cidades SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar cidades
	public function getAll(){
		$array = array();
		$sql = $this->db->query("SELECT * FROM cidades");

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
		$sql = $this->db->prepare("UPDATE cidades SET {$fields} WHERE id = '{$post['id']}' ");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar cidade
	public function get($id){
		$sql = $this->db->query("SELECT * FROM cidades WHERE id = '{$id}' ");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
}