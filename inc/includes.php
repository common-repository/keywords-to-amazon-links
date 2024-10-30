<?php
//Our class extends the WP_List_Table class, so we need to make sure that it's there
require_once('grid.php');
require_once('controller.php');
require_once('time.php');
require_once(ABSPATH . 'wp-includes/pluggable.php');

global $wpdb;

$wpdb->show_errors();