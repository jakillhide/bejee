<?php


class Auth
{

	public static function getTasks() {
		$db = Db::getConnection();

			if(isset($_GET['page'])){
			$result2 = $db->query("SELECT * FROM topics ORDER BY id ASC LIMIT 3 OFFSET ".$_GET['page']*3);
			}else{
			$result2 = $db->query("SELECT * FROM topics ORDER BY id ASC LIMIT 3 OFFSET 0");
			}
			
			return $result2;
	
	}
	
	public static function getDone() {
		
		$db = Db::getConnection();
		if (isset($_POST['done']) and $_POST['done'] == 1){
    			$db->query("UPDATE `topics` SET `status` = 1 WHERE id=".$_POST['zid']);
    			echo "Выполнено";
		}elseif(isset($_POST['done']) and $_POST['done'] == 0){
				$db->query("UPDATE `topics` SET `status` = 0 WHERE id=".$_POST['zid']);
				echo "Выполняется";
		}
	
	}
	
	
	public static function getEdit() {
	
		if(isset($_POST['exampleInputText']) and isset($_SESSION['auth'])){
				$db = Db::getConnection();
				$db->query("UPDATE `topics` SET `text` = '".$_POST['exampleInputText']."', `edit` = 1 WHERE id=".$_POST['idz']);
		}
	
	}	
	
	
	public static function getPages() {
	
				$db = Db::getConnection();
		$result = $db->query("SELECT * FROM topics ORDER BY id ASC");
		$pages = ceil($result->rowCount()/3);
		
		return $pages;
		
	}


	public static function getUser() {
	
		$db = Db::getConnection();
		session_start();
		
		if(isset($_POST['enter'])){
		
			$resultauth = $db->query("SELECT * FROM auth WHERE login='".$_POST['exampleInputLogin']."' AND pass='".$_POST['exampleInputPass']."'");
	
			if($resultauth->rowCount()==1){
			$_SESSION['auth']=md5($_POST['exampleInputLogin']).rand(1, 100);
			}else{
			
			$error = '<br/><div class="alert alert-danger" role="alert">Неправильный логин или пароль!</div>';
			return $error;
			}
		}
	
}

	public static function getUserExit() {
	
	if(isset($_POST['exit'])){

	session_destroy();
	header("Location: /auth/");
	}
	
	}
	
	
	
	
	
	

}