<?php
class Shorten{

	public $config = array
		(
			'DBNAME' 	=> 'shortener',
			'USERNAME' 		=> 'root',
			'PASSWORD' 	=> ''
		);
	public $conn;

	public function __construct(){
		$this->conn = $this->connection();
	}

	public function connection (){
		$config = $this->config;
		try{
			$conn = new PDO("mysql:host=localhost;dbname=".$config['DBNAME'], 
							$config['USERNAME'], $config['PASSWORD']);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn ;
		}catch(PDOException $e){
			return false;
		}
	}
	public function queryAll($query,$bindings,$conn){
		$conn = $this->conn;
		$result = $conn->prepare($query);
		$result->execute($bindings);
		while($result = $result->fetchAll() ){
			return $result;
		}		
	}

	public function redirect($code){
		$query = $this->queryAll("SELECT * FROM url WHERE code = :code",array('code'=>$code),$this->conn);
		if($query){
			return $query[0]['url'];
		}else{
			return false;
		}
	}

	
}



?>