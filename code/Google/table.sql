



CREATE TABLE IF NOT EXISTS `social_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `g_id` decimal(21,0) NOT NULL,
  `g_name` varchar(60) NOT NULL,
  `g_email` varchar(60) NOT NULL,
  `g_link` varchar(60) NOT NULL,
  `g_image` varchar(60) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
