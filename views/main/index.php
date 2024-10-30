<?php

//Prepare Table of elements
$wp_list_table = new KAL_Grid();

//options
global $wpdb;

$wp_list_table->query = "
	SELECT *
	FROM {$wpdb->prefix}kal_keywords
";
$wp_list_table->columns = array(
    'col_keyword'=>__('Keyword'),
    'col_url'=>__('URL'),
);
$wp_list_table->sortable = array(
    'col_keyword'=>array('keyword'),
    'col_url'=>array('url'),
);
$wp_list_table->fields = array(
    'col_keyword' => '%keyword%<div class="row-actions"><span class="edit"><a href="?page=' . $_GET['page'] . '&sub=' . $_GET['sub'] . '&sub2=edit&id=%id%">Edit</a> | <a href="?page=' . $_GET['page'] . '&sub=' . $_GET['sub'] . '&sub2=delete&id=%id%">Delete</a></span></div>',
    'col_url' => '%url%',
);
//create
$wp_list_table->prepare_items('keyword', 'ASC');
//Table of elements
$wp_list_table->display();
?>