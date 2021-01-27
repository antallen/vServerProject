<?php
	class dbconn{
		//PDO
		private $dbcon;
		//TableName
		private $dbtable;
		//ColumnName
		private $cname;
		//UserName
		private $uname;
		//搜尋結果
		private $result;
		
		function __construct($uname_i){
			//$this -> dbcon = $dbcon_i;
			//$this -> dbtable = $dbtable_i;
			//$this -> cname = $cname_i;
			$this -> uname = $uname_i;	
			
			return true;		
		}
		
		function select($dbcon1,$dbtable , $cname , $key , $key_value){
			$sql = "SELECT " . $cname . 
				   " FROM " . $dbtable . 
				   " WHERE " . $key . "=" . $key_value;
			//執行查詢
			try{   
				$stmt = $dbcon1 -> query($sql);
				var_dump($stmt);
			}
			catch(PDOException $e){
				//error message
				echo 'SQL error!!' . '<br>';
    			echo 'Message is: ' . $e->getMessage(); 
			}
			
			$this -> result = $stmt -> fetch();
		}
		
		public function getMessage(){			
			
			return $this -> result;
		}
			
	}
?>