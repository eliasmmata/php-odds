<?php
namespace BesoccerOdds\Classes;

class Mysql_db{
	
	public $connect_id;		
	public $database;
	public $credenciales;
	public $sql;	 
	
	function __construct(string $db = 'bigdata', $autoconnect=true) 
	{				
		$this->database = $db;
		
		if ($autoconnect) {
			if($this->connect_id === null) {
				$this->connect_id = $this->Connect();			
			};
		}
	}

	private function Connect()
    {
    	//Leer credenciales desde el  archivo ini
        $this->credenciales = parse_ini_file("../config/db/{$this->database}.php.ini");
		$this->connect_id = mysqli_connect($this->credenciales['host'],$this->credenciales['usuario'],$this->credenciales['clave']);		
		if($this->connect_id){
			if(mysqli_select_db($this->connect_id, $this->credenciales['dbnombre'])) {
				@mysqli_query($this->connect_id, 'SET NAMES utf8');
				return $this->connect_id;
			}else {
				return self::error();
			};
		}else {
			return self::error();
		};
	}
	
	private function error() 
	{
		if(!empty(mysqli_error($this->connect_id))) {
			$error = '<b>Sql: </b>'.$this->sql['query'].'<br/><b>MySQL Error</b>: '.mysqli_error($this->connect_id).'<br/>';
			return $error;
		}
	}
	
	function query($query)
	{					
		$this->sql['query'] = $query;	
		if(!isset($this->connect_id) || empty($this->connect_id)) {
			$this->connect_id = new mysql_db(false);			
			$this->connect_id->Connect();			
		};
		
		if ($this->sql['query'] != NULL) {			
			$data = @mysqli_query($this->connect_id, $this->sql['query']);
			if (is_bool($data) === true) {
				return $data;
			} else {
				if($data) {
					$aRec = [];
					while($aRow = mysqli_fetch_assoc($data)){
						$aRec[] = $aRow; 	
					};				
					return $aRec;
				};
			}
		}else {
			return FALSE;
		};
	}		
			
}
?>