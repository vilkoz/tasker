<?php
class Route
{
	private static function getNamesFromUrl()
	{
		$controller_name = 'main';
		$action_name = 'index';
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if (!empty($routes[1]))
		{
			$controller_name = $routes[1];
		}
		if (!empty($routes[2]))
		{
			$action_name = $routes[2];
		}
		return array(
			'controller' => $controller_name,
			'action' => $action_name
		);
	}

	private static function getPathFromNames($names)
	{
		$controller_path =
			"application/controllers/controller_" .
			strtolower($names['controller']) . '.php';
		$model_path =
			"application/models/model_" .
			strtolower($names['controller']) . '.php';
		$action_name = 'action' .
			ucwords(strtolower($names['action']));
		return array(
			'controller_path' => $controller_path,
			'model_path' => $model_path,
			'controller_name' => 'controller_' . $names['controller'],
			'action_name' => $action_name
		);
	}

	private static function errorPage404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST']."/";
		header('HTTP/1.1 404 Not Found');
		header('Status: 404 Not Found');
		header('Location:'.$host.'404');
	}

	private static function includeExisting($pathes)
	{
		if (file_exists($pathes['model_path']))
		{
			include $pathes['model_path'];
		}
		if (file_exists($pathes['controller_path']))
		{
			include $pathes['controller_path'];
		}
		else
		{
			self::errorPage404();
		}
		$controller = new $pathes['controller_name'];
		$action = $pathes['action_name'];
		if (method_exists($controller, $action))
		{
			$controller->$action();
		}
		else
		{
			echo $action.'not exists';
			self::errorPage404();
		}
	}

	static function start()
	{
		$names = self::getNamesFromUrl();
		$pathes = self::getPathFromNames($names);
		self::includeExisting($pathes);
	}
}
 ?>
