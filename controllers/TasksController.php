<?php

include_once ROOT. '/models/Tasks.php';

class TasksController {

	public function actionIndex()
	{

		$result2 = Tasks::getTasks();
		$pages = Tasks::getPages();
		Tasks::getAdd();

		
		require_once(ROOT . '/views/tasks/index.php');

		return true;
	}


}

