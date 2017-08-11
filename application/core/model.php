<?php
/**
 * Base model class
 */
class Model
{
	private $pdo;

	function __construct()
	{
		include 'config/database.php';
		try
		{
			$this->pdo = new PDO($DB_DSN, $DB_USER, $DB_PASS);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Exception $e)
		{
			echo "PDO connect error: ". $e->getMessage() . "<br/>";
			die();
		}
	}

	public function getPdo()
	{
		return ($this->pdo);
	}

	public function passwordHash($pass)
	{
		return (
			hash('sha256', hash('sha256', $pass) .
			'some very interesting salt with couple of random words such as:'.
			' horse atoms friday summer piano bulb carpet tree')
		);
	}

	public function getData()
	{
	}
}

?>
