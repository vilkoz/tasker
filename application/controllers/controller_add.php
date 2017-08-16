<?php
/**
 * Controller for new task page
 */
class Controller_add extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_add;
	}

	public function actionIndex()
	{
		$this->view->generate(
			Null,
			'view_add.php',
			array(
				'title' => 'Tasker'
			)
		);
	}

	private function saveImage($image_path, $image_type)
	{
        try
        {
            $image = @imagecreatefromstring(
                (file_get_contents($image_path))
            );
        }
        catch (Exception $e)
        {
			throw new Exception("This file format is not supported!");
        }
        if (!$image)
        {
			throw new Exception("This file format is not supported!");
        }
		list($width, $height) = getimagesize($image_path);
		$proportion = 1;
		if ($width > 320 || $height > 240)
		{
			if ($width / 320 > $height / 240)
				$proportion = 320 / $width;
			else
				$proportion = 240 / $height;
		}
		$new_width = $width * $proportion;
		$new_height = $height * $proportion;
		$scaled_image = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($scaled_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		$name = uniqid() . '.jpeg';
		imagejpeg($scaled_image, "images/" . $name, 100);
		return ($name);
	}

	public function actionNew()
	{
		if (!isset($_POST) ||
			!isset($_POST['username']) ||
			!isset($_POST['e-mail']) ||
			!isset($_POST['text']) ||
			!filter_var($_POST['e-mail'], FILTER_VALIDATE_EMAIL))
		{
			die("Please fill all required form fields!");
		}
		if (isset($_FILES) && isset($_FILES['file']))
		{
			try
			{
				$image_path = $this->saveImage(
					$_FILES['file']['tmp_name'],
					$_FILES['file']['type']);
			}
			catch (Exception $e)
			{
				die($e->getMessage());
			}
		}
		else
		{
			$image_path = 'none';
		}
		$data = array_filter($_POST, function ($k)
		{
			return $k == 'username' || $k == 'e-mail' || $k =='text';
		}, ARRAY_FILTER_USE_KEY);
		$data = array_map(function ($k)
		{
			return htmlspecialchars($k, ENT_QUOTES | ENT_HTML5);
		}, $data);
		$data['image'] = $image_path;
		$this->model->addTask($data);
		echo "SUCCESS";
	}
}

?>
