DROP TABLE IF EXISTS `#__wfs_configure`;
CREATE TABLE `#__wfs_configure` (
  `wfs_configure_id` int(200) NOT NULL auto_increment,
  `project_name` varchar(255) NOT NULL default '',
  `project_key` varchar(255) NOT NULL default '',
  `project_day` varchar(255) NOT NULL default '0-6',
  `project_page_option` enum('0','1','2') NOT NULL default '0',
  `project_pages` text NOT NULL,
  `project_options` enum('0','1') NOT NULL default '0',
  `is_active` enum('0','1') NOT NULL default '0' COMMENT '0>inActive, 1>Active',
  `user_id` varchar(255) NOT NULL default '',
  `user_type` enum('0','1') NOT NULL default '0' COMMENT '0>free, 1> paid',
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`wfs_configure_id`)
) ENGINE=MyISAM  AUTO_INCREMENT=0  DEFAULT CHARSET=utf8 ;
 
