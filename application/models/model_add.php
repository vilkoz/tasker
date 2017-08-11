<?php
/**
 * Model for new task page
 */
class Model_add extends Model
{
	private $pdo;

	function __construct()
	{
		parent::__construct();
		$this->pdo = parent::getPdo();
	}

	public function addTask($data)
	{
		$stmt = $this->pdo->prepare("INSERT INTO `tasks` (`tid`, `username`, `e-mail`, `text`, `image`, `status`) VALUES (NULL, :username, :email, :text, :image, '0')");
		$stmt->bindParam(":email", $data['e-mail']);
		$stmt->bindParam(":username", $data['username']);
		$stmt->bindParam(":text", $data['text']);
		$stmt->bindParam(":image", $data['image']);
		$stmt->execute();
	}
}

?>
