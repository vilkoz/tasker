<?php
/**
 * Controller for 404 erroe page
 */
class Controller_404 extends Controller
{
	public function actionIndex()
	{
		$this->view->generate(
			'view_404.php',
			'view_template.php',
			array('title' => 'No such page on Tasker')
		);
	}
}

 ?>
