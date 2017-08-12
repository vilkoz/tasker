<?php
if ($_SERVER['SERVER_NAME'] == 'tasker-vilkoz.herokuapp.com' || (isset($argv) && $argv[1] == 'heroku'))
{
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
	$host = $url['host'];
	$user = $url['user'];
	$pass = $url['pass'];
	$db = substr($url['path'], 1);
	$DB_DSN = 'mysql:dbname=' . $db .';host=' . $host;
	$DB_USER = $user;
	$DB_PASS = $pass;
}
else
{
	$DB_DSN = 'mysql:dbname=tasker;host=localhost';
	$DB_USER = 'root';
	$DB_PASS = '';
}
?>
