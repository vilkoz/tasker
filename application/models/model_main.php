<?php
/**
 * Model for main page
 */
class Model_Main extends Model
{
	private $pdo;

	function __construct()
	{
		parent::__construct();
		$this->pdo = parent::getPdo();
	}

	public function getTasks($offset = 0)
	{
		$count_stmt = $this->pdo->prepare("SELECT count(*) as 'count' FROM `tasks`");
		$count_stmt->execute();
		$task_count = $count_stmt->fetch()['count'];
		$stmt = $this->pdo->prepare("SELECT * FROM `tasks` LIMIT 3 OFFSET ".intval($offset * 3));
		$stmt->execute();
		$task_array = $stmt->fetchAll();
		return (array($task_array, $task_count));
	}

	public function toggleTask($tid)
	{
		$stmt = $this->pdo->prepare("UPDATE `tasks` SET `status` = 1 - `status` WHERE `tid` = :tid");
		$stmt->bindParam(":tid", $tid);
		$stmt->execute();
	}

	public function editText($tid, $text)
	{
		$text = htmlspecialchars($text, ENT_QUOTES | ENT_HTML5);
		$stmt = $this->pdo->prepare("UPDATE `tasks` SET `text` = :text WHERE `tid` = :tid");
		$stmt->bindParam(":tid", $tid);
		$stmt->bindParam(":text", $text);
		$stmt->execute();
	}
}

 ?>
