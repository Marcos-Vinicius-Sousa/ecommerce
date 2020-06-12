<?php 

namespace Hcode\Model;
use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model {

	const SESSION = "User";

	public  static function login($login,$password){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

		if(count($results) === 0 ){

			throw new \Exception("Usuário inexistente o senha inválida.");
		}

		$data = $results[0];
		if(password_verify($password, $data["despassword"]) === true ){

			$user = new User();

			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return 	$user;

		}else{

			throw new \Exception("Usuário inexistente o senha inválida.");
		}
	}

	public static function verifyLogin($inadmin = true){

<<<<<<< HEAD
		
=======
		var_dump($_SESSION);
>>>>>>> 596b3e6e2a21c3007506d5674c6205d4221a2d1c
		if(
			!isset($_SESSION[User::SESSION])// verificando se a sessao esta definida  
			||
			 !$_SESSION[User::SESSION] // verificando se a sessao for falsa
			|| 
			!(int)$_SESSION[User::SESSION]["iduser"] > 0   // verificando o id do usuario 
			||
			(bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin   // verificando se o usuario tem acesso a area de admin 	
		){

			header("Location: /admin/login");
			exit;
		}

	}

<<<<<<< HEAD
	public static function logout(){

		$_SESSION[User::SESSION] = NULL;
		exit;
	}

	public static function listAll(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users  a inner join tb_persons b using(idperson) order by b.desperson");
	}

	public function save(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_users_save(:desperson , :deslogin , :despassword , :desemail, :nrphone, :inadmin)", array(
			":desperson"=>$this->getdesperson(),
			":deslogin"=>$this->getdeslogin(),
			":despassword"=>$this->getdespassword(),
			":desemail"=>$this->getdesemail(),
			":nrphone"=>$this->getnrphone(),
			":inadmin"=>$this->getinadmin()
		));

		$this-> setData($results[0]);
	}



=======
>>>>>>> 596b3e6e2a21c3007506d5674c6205d4221a2d1c
}

?>