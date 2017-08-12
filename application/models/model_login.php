<?php
/**
 *
 */
class Model_login extends Model
{
	private $pdo;

	function __construct()
	{
		parent::__construct();
		$this->pdo = parent::getPdo();
	}

	public function loginUser($user, $pass)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `username` = :user AND `password` = :pass");
		$stmt->bindParam(':user', $user);
		$pass = $this->passwordHash($pass);
		$stmt->bindParam(':pass', $pass);
		$stmt->execute();
		return ($stmt->fetch());
	}
}

 ?>
