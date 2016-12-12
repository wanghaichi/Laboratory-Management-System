CREATE TABLE `lms_reservation_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(20) DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `software` varchar(255) DEFAULT NULL COMMENT 'software the class needs',
  `student_category` int(11) DEFAULT '0' COMMENT '0 for undergraduate . 1 for postgraduate.  2 for Ph.D',
  `remark` text COMMENT 'remarks',
  `class_category` varchar(100) DEFAULT NULL COMMENT '0 for course, 1 for temporarily using',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8
