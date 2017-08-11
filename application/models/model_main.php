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
}

 ?>
