<?php

global $wpdb, $kal_db_version;

$sql = "
CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}kal_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
)
";
dbDelta($sql);

update_option( "kal_db_version", $kal_db_version );