<?php

$c = new KAL_Controller();
global $wpdb;



//MAIN
if ($_GET['sub'] == 'settings' || $_GET['sub'] == '') {

	//DEFAULT ACTION
	if ($_GET['sub2'] == 'index' || $_GET['sub2'] == '') {

		/*$survey_models = $wpdb->get_results("
			   SELECT *
			   FROM {$wpdb->prefix}survey
		");*/

		//$c->page_title = 'Page Title';
		$content = $c->renderPartial(KAL_PLUGIN_PATH . 'views/settings/index.php');

	}

}


include(KAL_PLUGIN_PATH . 'views/layout.php');

?>