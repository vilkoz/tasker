<?php
/**
 * controller for main page
 */
class Controller_Main extends Controller
{
	public function actionIndex()
	{
		$this->view->generate(
			'view_main.php',
			'view_template.php',
			array('title' => 'Tasker')
		);
	}
}

?>
