<html>
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>登入失敗</title>
    </head>
    
    <body>
    	<?php
		require "../dbconn.php";
		
		//字串組
		$nouserdata = 'Please check your username or password!!';		
		
		$dbhost = 'localhost';
		$dbname = 'vServer';
		$dbuser = 'vServer';
		$dbpasswd = '';
		$user = $_POST['username'];
		$userpasswd = $_POST['userpwd'];
				
		if(!$user){
			echo "<script>alert('No keyin user.');location.href='../login.php';</script>";
		}
		else{
			try{
				$dbcon = new PDO('mysql:host=' . $dbhost . ";dbname=" . $dbname,$dbuser,$dbpasswd);
			}
			catch(PDOException $e){
    			//error message
				echo 'Link mysql error!!' . '<br>';
    			echo 'Message is: ' . $e->getMessage(); 
			}
			
			/*
			//TableName
			$dbtable = 'adminuser';
			$dbrowName = array('password','loginname','createdate','level');
			//將欄位串成字串，並以','做分隔
			$dbrowStr = implode(',',$dbrowName);
			//Select Key
			$key = 'loginname';
			$key_value = $user;
			$result = new dbconn($user);
			$row = $result -> select($dbcon , $dbtable , $dbrowStr , $key , $key_value);
			$row = $result -> getMessage();
			*/
			
			//查詢指令
			//TableName
			$dbtable = 'adminuser';
			//要查詢Table的欄位
			$dbrowName = array('password', 'userId' , 'loginname','createdate','level');
			//將欄位串成字串，並以','做分隔
			$dbrowStr = implode(',',$dbrowName);
			
			$strSql = 'SELECT ' . $dbrowStr . ' FROM ' . $dbtable . ' WHERE loginname=:loginname' ;
			
			try{
				//將sql指令載入，準備查詢
    			$stmt = $dbcon -> prepare($strSql);
				
				//執行查詢
				$stmt -> execute(array("loginname" => $user));
			}
			catch(PDOException $e){
    			//error message
				echo 'SQL error!!' . '<br>';
    			echo 'Message is: ' . $e->getMessage(); 
			}
			
			//顯示結果			
			$row = $stmt -> fetch();
			/*echo '<hr>';
			var_dump($result);
			echo '<hr>';*/
			if(!$row){
				echo "<script>alert('" . $nouserdata . "');location.href='../login.php';</script>";
			}
			else{
				//密碼檢查
				$userpasswd_data = substr($row[$dbrowName[0]],5);
				$userpasswd_chk = base64_encode(sha1($userpasswd,true));
				if($userpasswd_chk == $userpasswd_data){
					/*echo '搜尋結果' . '<br>';
					echo 'Check PASS!!' . '<br>';
					echo 'Login userid is: ' . $row[$dbrowName[1]] . '<br>' . 
						 '  Login user is: ' . $row[$dbrowName[2]] . '<br>' . 
						 '       Level is: ' . $row[$dbrowName[4]] . '<br>';*/
					session_start();
					$_SESSION['user'] = $user;
					$_SESSION['userpassword'] = $userpasswd;
					$_SESSION['uid'] = $row[$dbrowName[1]];
					$_SESSION['level'] = $row[$dbrowName[4]];
					$_SESSION['loginCheck'] = 'pass';					
						 
					header("Location:../index.php" );
				}
				else{
					echo "<script>alert('" . $nouserdata . "');location.href='../login.php';</script>";
				}
			}						
			
			//結束連線
			$dbcon = null;				
		}			

		?>
        
        
    </body>
</html>
