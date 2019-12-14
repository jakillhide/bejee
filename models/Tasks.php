<?php


class Tasks
{

	public static function getTasks() {
		$db = Db::getConnection();

			if(isset($_GET['sort'])){
	$result2 = $db->query("SELECT * FROM topics ORDER BY ".$_GET['sort']." ".$_GET['pos']." LIMIT 3 OFFSET ".(int)$_GET['page']*3);
		}elseif(isset($_GET['page'])){
	$result2 = $db->query("SELECT * FROM topics ORDER BY id ASC LIMIT 3 OFFSET ".$_GET['page']*3);
		}else{
	$result2 = $db->query("SELECT * FROM topics ORDER BY id ASC LIMIT 3 OFFSET 0");
		}	
			
			return $result2;
	
	}
	
	public static function getAdd() {
	
		if(isset($_POST['exampleInputName'])){
				$db = Db::getConnection();
				$db->query("INSERT INTO `topics` (`name`, `email`, `text`) VALUES ('".$_POST['exampleInputName']."', '".$_POST['exampleInputEmail']."', '".htmlspecialchars($_POST['exampleInputText'])."')");
			
			}
	
	}
	
	
	
	public static function getPages() {
	
				$db = Db::getConnection();
		$result = $db->query("SELECT * FROM topics ORDER BY id ASC");
		$pages = ceil($result->rowCount()/3);
		
		return $pages;
		
	}

	
	
	
	
	
	

}