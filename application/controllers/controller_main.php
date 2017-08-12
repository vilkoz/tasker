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
		if (isset($_GET) && isset($_GET['page']) && isset($_GET['ob']))
		{
			$ob = $_GET['ob'];
			$page = intval($_GET['page']);
			list($tasks, $task_count) =
				$this->model->getTasks($ob, $page);
		}
		else if (isset($_GET) && isset($_GET['page']))
		{
			$page = intval($_GET['page']);
			list($tasks, $task_count) = $this->model->getTasks('tid', $page);
		}
		else
		{
			$page = 0;
			list($tasks, $task_count) = $this->model->getTasks('tid', 0);
		}
		$this->view->generate(
			'view_main.php',
			'view_template.php',
			array(
				'title' => 'Tasker',
				'tasks' => $tasks,
				'count' => $task_count,
				'page' => $page,
				'ob' => isset($ob) ? $ob : ""
			)
		);
	}
	public function actionToggle()
	{
		if (!isset($_SESSION))
			session_start();
		if (!isset($_SESSION) || !isset($_SESSION['user']) || $_SESSION['user'] !== 'admin')
			die("YOU DO NOT HAVE PERMISSIONS FOR THAT");
		if (!isset($_POST) || !isset($_POST['tid']))
			die("NOT ENOUGH PARAMETERS");
		$this->model->toggleTask(intval($_POST['tid']));
	}

	public function actionEdit()
	{
		if (!isset($_SESSION))
			session_start();
		if (!isset($_SESSION) || !isset($_SESSION['user']) || $_SESSION['user'] !== 'admin')
			die("YOU DO NOT HAVE PERMISSIONS FOR THAT");
		if (!isset($_POST) || !isset($_POST['tid']) || !isset($_POST['text']))
			die("NOT ENOUGH PARAMETERS");
		$this->model->editText(intval($_POST['tid']), $_POST['text']);
	}
}

?>
