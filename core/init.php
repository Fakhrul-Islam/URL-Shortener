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
	public function query($query,$bindings,$conn){
		$conn = $this->conn;
		$result = $conn->prepare($query);
		$result->execute($bindings);
		return $result;			
	}

	public function redirect($code){
		$query = $this->queryAll("SELECT * FROM url WHERE code = :code",array('code'=>$code),$this->conn);
		if($query){
			return $query[0]['url'];
		}else{
			return false;
		}
	}

	public function genereateCode($code){
		return base_convert($code, 10, 30);
	}

	public function mkurl($url){
		$url = htmlspecialchars(trim($url));
		$conn = $this->conn;
		if(!filter_var($url,FILTER_VALIDATE_URL)){
			return false;
		}else{
			$query = $this->query("SELECT * FROM url WHERE url = :url",array('url'=>$url),$conn);
			$query = $query->fetchAll();
			if( $query->rowCount()>0){
				$code = $query[0]['code'];
				return $code;
			}else{
				$query = $this->query("INSERT INTO url(url,addtime) VALUES(:url,now())",array('url'=>$url),$conn);
				$id = $conn->lastInsertId();
				$genCode = $this->genereateCode($id);
				$query = query("INSERT INTO url(code) VALUES(:code) WHERE id = :id",array('code'=>$genCode,'id'=>$id),$conn);
				return $genCode;
			}
		}
		
	}

	
}



?>