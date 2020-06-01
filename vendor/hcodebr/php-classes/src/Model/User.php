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

		var_dump($_SESSION);
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

}

?>