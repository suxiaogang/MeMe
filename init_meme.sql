CREATE TABLE IF NOT EXISTS `todolist` (
  `tid` int(255) NOT NULL AUTO_INCREMENT,
  `type` int(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `userip` varchar(255) DEFAULT NULL,
  `useragent` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19880101;
