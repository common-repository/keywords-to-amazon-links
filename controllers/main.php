<?php

$c = new KAL_Controller();
global $wpdb;


//MAIN
if ($_GET['sub'] == 'main' || $_GET['sub'] == '') {

	//DEFAULT ACTION
	if ($_GET['sub2'] == 'index' || $_GET['sub2'] == '') {

		//$c->page_title = 'Page Title';
		$content = $c->renderPartial(KAL_PLUGIN_PATH . 'views/main/index.php');

	}

    if($_GET['sub2'] == 'edit') {

        if($_POST)
        {
            $keyword_model = (object)$_POST;
            if($keyword_model->keyword != '')
            {
                //update the survey itself
                $wpdb->query(
                    $wpdb->prepare("
                        UPDATE {$wpdb->prefix}kal_keywords
                        SET keyword = %s, url = %s
                        WHERE id = %s
                        LIMIT 1
                    ", $_POST['keyword'], $_POST['url'], $_GET['id'])
                );
                wp_redirect("?page=kal&sub=main");
                exit;
            } else {
                $c->message_type = 'error';
                $c->message = 'You must supply a keyword';
            }
        }

        $keyword_model = $wpdb->get_row(
            $wpdb->prepare("
			   SELECT *
			   FROM {$wpdb->prefix}kal_keywords
			   WHERE id = %s
			", $_GET['id']
            )
        );

        $content = $c->renderPartial(KAL_PLUGIN_PATH . 'views/main/edit.php', array('keyword_model' => $keyword_model));

    }

    if($_GET['sub2'] == 'create') {

        if($_POST)
        {
            $keyword_model = (object)$_POST;
            if($keyword_model->keyword != '')
            {
                //update the survey itself
                $wpdb->query(
                    $wpdb->prepare("
                            INSERT INTO {$wpdb->prefix}kal_keywords
                            SET keyword = %s, url = %s
                        ", $_POST['keyword'], $_POST['url'])
                );
                wp_redirect("?page=kal&sub=main");
                exit;
            } else {
                $c->message_type = 'error';
                $c->message = 'You must supply a keyword';
            }
        }

        $content = $c->renderPartial(KAL_PLUGIN_PATH . 'views/main/create.php', array('keyword_model' => $keyword_model));

    }

    if($_GET['sub2'] == 'delete') {

        if($_GET['id'])
        {
            $wpdb->query(
                $wpdb->prepare("
						DELETE FROM {$wpdb->prefix}kal_keywords
						WHERE id = %s
					",
                    $_GET['id']
                )
            );
            wp_redirect("?page=kal&sub=main");
            exit;
        }

    }

}

include(KAL_PLUGIN_PATH . 'views/layout.php');

?>