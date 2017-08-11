<?php
/**
 * controller for main page
 */
class Controller_Main extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_Main;
	}

	public function actionIndex()
	{
		if (isset($_GET) && isset($_GET['page']) && !empty($_GET['page']))
		{
			$page = intval($_GET['page']);
			list($tasks, $task_count) =
				$this->model->getTasks(intval($_GET['page']));
		}
		else
		{
			$page = 0;
			list($tasks, $task_count) = $this->model->getTasks();
		}
		$this->view->generate(
			'view_main.php',
			'view_template.php',
			array(
				'title' => 'Tasker',
				'tasks' => $tasks,
				'count' => $task_count,
				'page' => $page
			)
		);
	}
}

?>
