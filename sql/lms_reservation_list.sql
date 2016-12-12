CREATE TABLE `lms_reservation_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info_id` int(10) unsigned DEFAULT NULL,
  `num_week` int(11) DEFAULT NULL,
  `num_day` int(11) DEFAULT NULL COMMENT 'such as Monday',
  `num_course` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8
