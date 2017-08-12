<?php
/**
 *
 */
class Controller_login extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_login;
	}

	function actionIndex()
	{
		$this->view->generate(Null, 'view_login.php', Null);
	}

	function actionLogin()
	{
		if (!isset($_SESSION))
			session_start();
		if (!isset($_POST) || !isset($_POST['username']) ||
			!isset($_POST['password']))
			die('Please fill all required fields!');
		if ($this->model->loginUser($_POST['username'], $_POST['password']))
		{
			$_SESSION['user'] = 'admin';
			echo "SUCCESS";
		}
		else
		{
			die("Wrong credentials!");
		}
	}

	public function actionLogout()
	{
		if (!isset($_SESSION))
			session_start();
		unset($_SESSION['user']);
	}
}

?>
