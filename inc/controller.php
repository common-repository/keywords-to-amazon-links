<?php

if(!class_exists('KAL_Controller')) {
class KAL_Controller {

	public $page_title;
    public $message;
    public $message_type;

	function renderPartial($file, $params = array())
	{
		extract($params);
		ob_start();
		include($file);
		$content = ob_get_clean();
		return $content;
	}

}
}