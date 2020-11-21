<?php
class Usuarios extends model{
	//registrar cidades
	public function set($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO usuarios SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar usuarios
	public function getAll(){
		$array = array();
		$sql = $this->db->query("SELECT * FROM usuarios");

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		return $array;
	}
	//atualizar usuarios
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE usuarios SET {$fields} WHERE id = '{$post['id']}' ");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//contar usuarios
	public function count(){
		$sql = $this->db->query("SELECT COUNT(*) as c FROM usuarios");
		$sql =  $sql->fetch(PDO::FETCH_ASSOC);
		return $sql['c'];
	}
	//verificar nivel de usuario	
	public function verificarNivel($id){
		$sql = $this->db->query("SELECT definicao FROM usuarios WHERE id = '{$id}' ");
		$nivel = $sql->fetch(PDO::FETCH_ASSOC);

		if ($nivel['definicao'] == 1) {
			return true;
		} else {
			return false;
		}
	}
	//dados do usuario
	public function get($id){
		$sql = $this->db->query("SELECT * FROM usuarios WHERE id = '{$id}' ");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	//login de usuarios
	public function login($post){
		$sql = $this->db->prepare('
			SELECT id FROM usuarios 
			WHERE email = :email
			AND senha = :senha
			AND status = 1');
		$sql->bindValue(':email', $post['email']);
		$sql->bindValue(':senha', md5($post['senha']));
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch(PDO::FETCH_ASSOC);
			$_SESSION['cLogin'] = $dados['id'];			
			return true;
		} else {
			return false;
		}
	}
}