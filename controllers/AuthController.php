<?php

include_once ROOT. '/models/Auth.php';

class AuthController {

	public function actionIndex()
	{
		
		$error = Auth::getUser();
		Auth::getUserExit();
		$result2 = Auth::getTasks();
		$pages = Auth::getPages();
		Auth::getDone();
		Auth::getEdit();
		
		require_once(ROOT . '/views/auth/index.php');

		return true;
	}


}

