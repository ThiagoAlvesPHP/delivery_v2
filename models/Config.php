<?php
class Config extends model{
	//atualizar configurações
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE config SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar configurações
	public function get(){
		$sql = $this->db->query("
			SELECT config.*, 
			cidades.cidade 
			FROM config
			INNER JOIN cidades
			ON config.id_cidade = cidades.id
			");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//contar produtos
	public function getUsuario($id){
		$sql = $this->db->query("SELECT * FROM usuarios WHERE id = '{$id}' ");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//registrar horarios de funcionamento
	public function setHorario($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO config_horario_funcionamento SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar configurações
	public function getAllHorarios(){
		$sql = $this->db->query("SELECT * FROM config_horario_funcionamento");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//atualizar horario
	public function upHorario($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE config_horario_funcionamento SET {$fields} WHERE id = '{$post['id']}' ");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
}