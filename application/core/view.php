<?php
/**
 * Base view class
 */
class View
{
	public function generate($content_view, $template_view, $data = Null)
	{
		if (is_array($data))
		{
			$data = array_filter($data, function ($k) {
				return ($k != 'content_view' && $k != 'template_view');
			}, ARRAY_FILTER_USE_KEY);
			extract($data);
		}
		include 'application/views/' . $template_view;
	}
}

?>
